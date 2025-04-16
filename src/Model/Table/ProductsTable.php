<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \App\Model\Table\ProductVariantsTable&\Cake\ORM\Association\HasMany $ProductVariants
 * @method \App\Model\Entity\Product newEmptyEntity()
 * @method \App\Model\Entity\Product newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Product> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Product findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Product> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Product>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Product> deleteManyOrFail(iterable $entities, array $options = [])
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

        $this->belongsToMany('AttributeValues', [
            'through' => 'ProductAttributes',
            'foreignKey' => 'product_id',
            'targetForeignKey' => 'attribute_value_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
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
            ->integer('stock_quantity')
            ->requirePresence('stock_quantity', 'create')
            ->notEmptyString('stock_quantity')
            ->greaterThan('base_price', 0, 'Base price must be a positive number.');

        $validator
            ->integer('stock_quantity')
            ->requirePresence('stock_quantity', 'create')
            ->notEmptyString('stock_quantity')
            ->greaterThan('stock_quantity', 0, 'Stock quantity must be a positive integer.');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        return $validator;
    }

    /**
     * @param $name
     * @param $excludeId
     * @return string
     */
    public function generateSlug($name, $excludeId = null): string
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

        // Check if slug already exists and append a number if necessary
        $slugBase = $slug;
        $counter = 1;

        while ($this->exists(['slug' => $slug, 'id !=' => $excludeId])) {
            $slug = $slugBase . '-' . $counter++;
        }

        return $slug;
    }

    /**
     * Fetches all attributes and their associated distinct values for product filtering.
     *
     * @return array An array where keys are attribute names and values are arrays of distinct values.
     */
    public function productFilters(): array
    {
        $attributesTable = TableRegistry::getTableLocator()->get('Attributes');
        $attributeValuesTable = TableRegistry::getTableLocator()->get('AttributeValues');
        $filterOptions = [];

        $attributes = $attributesTable->find('all')->toArray();

        foreach ($attributes as $attribute) {
            $values = $attributeValuesTable->find('all')
                ->where(['attribute_id' => $attribute->id])
                ->distinct(['value'])
                ->orderBy(['value' => 'ASC'])
                ->all()
                ->extract('value')
                ->toArray();

            if (!empty($values)) {
                $filterOptions[$attribute->name] = $values;
            }
        }

        return $filterOptions;
    }

    /**
     * Fetches products based on the provided filter parameters.
     *
     * @param \Cake\ORM\Query $query The base query object.
     * @param array $filters An array of filter parameters (attributeName => [value1, value2, ...]).
     * @return \Cake\ORM\Query The modified query object with filters applied.
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

        // Apply filters: Mtch ANY attribute group via product OR variant
        foreach ($attributeValueGroups as $valueIds) {
            $query->where(function ($exp, $q) use ($valueIds) {
                return $exp->or([
                    'ProductAttributes.attribute_value_id IN' => $valueIds,
                    'ProductVariantAttributes.attribute_value_id IN' => $valueIds
                ]);
            });
        }

        return $query
            ->leftJoinWith('ProductAttributes')
            ->leftJoinWith('ProductVariants.ProductVariantAttributes')
            ->distinct(['Products.id']);
    }

    /**
     * @param string $slug
     * @return SelectQuery
     */
    public function findBySlug(string $slug): SelectQuery
    {
        return $this->find()->where(['slug' => $slug]);
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
