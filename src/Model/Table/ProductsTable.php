<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\Product;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Association\HasMany;
use Cake\ORM\Query;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
use Cake\Validation\Validator;
use Closure;
use Psr\SimpleCache\CacheInterface;

/**
 * Products Model
 *
 * @property ProductVariantsTable&HasMany $ProductVariants
 * @method Product newEmptyEntity()
 * @method Product newEntity(array $data, array $options = [])
 * @method array<Product> newEntities(array $data, array $options = [])
 * @method Product get(mixed $primaryKey, array|string $finder = 'all', CacheInterface|string|null $cache = null, Closure|string|null $cacheKey = null, mixed ...$args)
 * @method Product findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method Product patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method array<Product> patchEntities(iterable $entities, array $data, array $options = [])
 * @method Product|false save(EntityInterface $entity, array $options = [])
 * @method Product saveOrFail(EntityInterface $entity, array $options = [])
 * @method iterable<Product>|ResultSetInterface<Product>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<Product>|ResultSetInterface<Product> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<Product>|ResultSetInterface<Product>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<Product>|ResultSetInterface<Product> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProductsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('ProductVariants', [
            'foreignKey' => 'product_id',
        ]);

        $this->hasMany('ProductAttributes', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('ProductImages', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsToMany('Attributes', [
            'through' => 'ProductAttributes',
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'attribute_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param Validator $validator Validator instance.
     * @return Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('category')
            ->maxLength('category', 255)
            ->requirePresence('category', 'create')
            ->notEmptyString('category');

        $validator
            ->decimal('base_price')
            ->requirePresence('base_price', 'create')
            ->notEmptyString('base_price');


        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        return $validator;
    }

    /**
     * @param EventInterface $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     * @return void
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {
        if ($entity->isNew() && !$entity->slug) {
            $slugBase = strtolower(Text::slug($entity->name));

            $slug = substr($slugBase, 0, 191);
            $counter = 1;

            $conditions = ['slug' => $slug];
            if (!$entity->isNew()) {
                $conditions['id !='] = $entity->id;
            }

            while ($this->exists($conditions)) {
                $slug = substr($slugBase . '-' . $counter++, 0, 191);
                $conditions['slug'] = $slug;
            }
            $entity->slug = $slug;
        }
    }

    /**
     * Fetches all attributes and their associated distinct values for product filtering,
     * limited to the given product IDs.
     *
     * @param array $productIds List of product IDs to filter against.
     * @return array An array where keys are attribute names and values are arrays of distinct values.
     */
    public function productFilters(array $productIds): array
    {
        if (empty($productIds)) {
            return [];
        }

        $attributeValuesTable = TableRegistry::getTableLocator()->get('AttributeValues');
        $variantAttributesTable = TableRegistry::getTableLocator()->get('ProductVariantAttributes');

        // Get attribute_value_ids from variant attributes linked to the products
        $variantAttributeValueIds = $variantAttributesTable->find()
            ->select(['ProductVariantAttributes.attribute_value_id'])
            ->distinct()
            ->matching('ProductVariants', function ($q) use ($productIds) {
                return $q->where(['ProductVariants.product_id IN' => $productIds]);
            })
            ->all()
            ->extract('attribute_value_id')
            ->toArray();

        if (empty($variantAttributeValueIds)) {
            return [];
        }

        // Fetch only the attribute values that are in use
        $usedAttributeValues = $attributeValuesTable->find()
            ->where(['AttributeValues.id IN' => $variantAttributeValueIds])
            ->contain(['Attributes']) // Make sure 'Attributes' association exists
            ->all();

        $filterOptions = [];

        foreach ($usedAttributeValues as $value) {
            $attributeName = $value->attribute->name;
            if (!isset($filterOptions[$attributeName])) {
                $filterOptions[$attributeName] = [];
            }

            if (!in_array($value->value, $filterOptions[$attributeName])) {
                $filterOptions[$attributeName][] = $value->value;
            }
        }

        // Sort values alphabetically for each attribute
        foreach ($filterOptions as &$values) {
            sort($values);
        }

        return $filterOptions;
    }

    /**
     * Fetches products based on the provided filter parameters.
     *
     * @param Query $query The base query object.
     * @param array $filters An array of filter parameters (attributeName => [value1, value2, ...]).
     * @return Query The modified query object with filters applied.
     */
    public function findFiltered(SelectQuery $query, array $filters): SelectQuery
    {
        $attributeValuesTable = TableRegistry::getTableLocator()->get('AttributeValues');

        // Get groups of attribute_value_ids by filter
        $attributeValueGroups = [];

        foreach ($filters as $attributeName => $selectedValues) {
            if (!is_array($selectedValues) || empty($selectedValues)) {
                continue;
            }

            $ids = $attributeValuesTable->getValueIdsForFilter($attributeName, $selectedValues);
            if (!empty($ids)) {
                $attributeValueGroups[] = $ids;
            }
        }

        // Apply filters: each group of selected values (OR across value IDs)
        foreach ($attributeValueGroups as $valueIds) {
            $query->where(function ($exp, $q) use ($valueIds) {
                return $exp->in('ProductVariantAttributes.attribute_value_id', $valueIds);
            });
        }

        return $query
            ->leftJoinWith('ProductVariants.ProductVariantAttributes')
            ->distinct(['Products.id']);
    }


    /**
     * @param string $slug
     * @return Product
     */
    public function findBySlug(string $slug): Product
    {
        return $this->find()
            ->where(['slug' => $slug])
            ->contain([
                'ProductImages',
                'ProductVariants.ProductVariantImages',
                'ProductVariants.ProductVariantAttributes.AttributeValues.Attributes',
            ])
            ->firstOrFail();
    }


    /**
     * Finds products and variants using a full-text search query.
     *
     * @param string $queryTerm The search term.
     * @return array Array of results.
     */
    public function findProductsByFullText(string $queryTerm): array
    {
        $conn = $this->getConnection();

        $sql = "
        (
            SELECT
                p.id,
                p.name AS title,
                p.description,
                p.category,
                p.base_price AS price,
                NULL AS variant_name,
                NULL AS variant_value,
                NULL AS sku,
                NULL AS product_id,
                'product' AS type
            FROM products p
            WHERE MATCH(p.name, p.description, p.category) AGAINST (:term IN BOOLEAN MODE)
        )
        UNION
        (
            SELECT
                pv.product_id AS id,
                NULL AS title,
                NULL AS description,
                NULL AS category,
                pv.price,
                NULL AS variant_name,
                NULL AS variant_value,
                pv.sku,
                pv.product_id,
                'variant' AS type
            FROM product_variants pv
            WHERE MATCH(pv.sku) AGAINST (:term IN BOOLEAN MODE)
        )
    ";

        return $conn->execute($sql, ['term' => $queryTerm])->fetchAll('assoc');
    }

    /**
     * Finds products and variants using a LIKE search query (fallback).
     *
     * @param string $likeTerm The like search term.
     * @return array Array of results.
     */
    public function findProductsByLike(string $likeTerm): array
    {
        $conn = $this->getConnection();

        $sql = "
        (
            SELECT
                p.id,
                p.name AS title,
                p.description,
                p.category,
                p.base_price AS price,
                NULL AS variant_name,
                NULL AS variant_value,
                NULL AS sku,
                NULL AS product_id,
                'product' AS type
            FROM products p
            WHERE p.name LIKE :like OR p.description LIKE :like
        )
        UNION
        (
            SELECT
                pv.product_id AS id,
                NULL AS title,
                NULL AS description,
                NULL AS category,
                pv.price,
                NULL AS variant_name,
                NULL AS variant_value,
                pv.sku,
                pv.product_id,
                'variant' AS type
            FROM product_variants pv
            WHERE pv.sku LIKE :like
        )
    ";

        return $conn->execute($sql, ['like' => $likeTerm])->fetchAll('assoc');
    }

    /**
     * @param string $queryTerm
     * @return array
     */
    public function search(string $queryTerm): array
    {
        $results = [];
        $usedFallback = false;

        if (!empty($queryTerm)) {
            $results = $this->findProductsByFullText($queryTerm);

            if (empty($results)) {
                $usedFallback = true;
                $likeTerm = '%' . $queryTerm . '%';
                $results = $this->findProductsByLike($likeTerm);
            }
        }

        // Collect all products
        $products = [];
        foreach ($results as $row) {
            if ($row['type'] === 'product') {
                $products[$row['id']] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'description' => $row['description'],
                    'category' => $row['category'],
                    'price' => $row['price'],
                    'variants' => [],
                ];
            }
        }

        // Attach variants to their corresponding product by product_id
        foreach ($results as $row) {
            if (
                $row['type'] === 'variant' &&
                isset($row['product_id']) &&
                isset($products[$row['product_id']])
            ) {
                $products[$row['product_id']]['variants'][] = [
                    'variant_name' => $row['variant_name'],
                    'variant_value' => $row['variant_value'],
                    'sku' => $row['sku'],
                    'price' => $row['price'],
                ];
            }
        }

        return [
            'results' => array_values($products),
            'usedFallback' => $usedFallback,
        ];
    }
}
