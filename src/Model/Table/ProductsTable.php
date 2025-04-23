<?php
declare(strict_types=1);

namespace App\Model\Table;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
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
            ->lessThanOrEqual('stock_quantity', 9999, 'Stock cannot exceed 9999.')
            ->notEmptyString('stock_quantity');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        return $validator;
    }

    /**
     * @param \Cake\Event\EventInterface $event
     * @param \Cake\Datasource\EntityInterface $entity
     * @param \ArrayObject $options
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
        $productAttributesTable = TableRegistry::getTableLocator()->get('ProductAttributes');
        $variantAttributesTable = TableRegistry::getTableLocator()->get('ProductVariantAttributes');

        $filterOptions = [];

        // Get attribute_value_ids from direct product attributes
        $productAttributeValueIds = $productAttributesTable->find()
            ->select(['attribute_value_id'])
            ->where(['product_id IN' => $productIds])
            ->distinct()
            ->all()
            ->extract('attribute_value_id')
            ->toArray();

        // Get attribute_value_ids from variant attributes linked to the same products
        $variantAttributeValueIds = $variantAttributesTable->find()
            ->select(['ProductVariantAttributes.attribute_value_id'])
            ->distinct()
            ->matching('ProductVariants', function ($q) use ($productIds) {
                return $q->where(['ProductVariants.product_id IN' => $productIds]);
            })
            ->all()
            ->extract('attribute_value_id')
            ->toArray();

        $usedValueIds = array_unique(array_merge($productAttributeValueIds, $variantAttributeValueIds));

        if (empty($usedValueIds)) {
            return [];
        }

        // Fetch only the attribute values that are in use
        $usedAttributeValues = $attributeValuesTable->find()
            ->where(['AttributeValues.id IN' => $usedValueIds])
            ->contain(['Attributes']) // Make sure this association exists
            ->all();

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
                    'ProductVariantAttributes.attribute_value_id IN' => $valueIds,
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
     * @return \Cake\ORM\Query\SelectQuery
     */
    public function findBySlug(string $slug): array
    {
        $product = $this->find()
            ->where(['slug' => $slug])
            ->contain([
                'ProductImages',
                'ProductAttributes.AttributeValues.Attributes',
                'ProductVariants.ProductVariantImages',
                'ProductVariants.ProductVariantAttributes.AttributeValues.Attributes',
            ])
            ->firstOrFail();

        $attributeOptions = [];
        $variantData = [];

        foreach ($product->product_variants as $variant) {
            $variantAttributes = [];

            foreach ($variant->product_variant_attributes as $pva) {
                $attrName = $pva->attribute_value->attribute->name;
                $attrValue = $pva->attribute_value->value;

                $variantAttributes[$attrName] = $attrValue;

                // Collect unique options
                $attributeOptions[$attrName][] = $attrValue;
            }

            $variantData[] = [
                'id' => $variant->id,
                'sku' => $variant->sku,
                'price' => $variant->price,
                'stock_quantity' => $variant->stock_quantity,
                'images' => collection($variant->product_variant_images)->extract('image_url')->toList(),
                'attributes' => $variantAttributes,
            ];
        }

        // Deduplicate attribute values
        foreach ($attributeOptions as $key => $values) {
            $attributeOptions[$key] = array_unique($values);
        }

        return [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'description' => $product->description,
            'category' => $product->category,
            'base_price' => $product->base_price,
            'images' => collection($product->product_images)->extract('image_url')->toList(),
            'attributes' => $attributeOptions,
            'variants' => $variantData,
        ];
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
