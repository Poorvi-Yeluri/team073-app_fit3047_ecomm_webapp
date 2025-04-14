<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
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
            ->notEmptyString('stock_quantity');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        return $validator;
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
        SELECT
            'product' AS type,
            id,
            name AS title,
            description,
            category,
            base_price AS price,
            NULL AS variant_name,
            NULL AS variant_value,
            NULL AS sku,
            NULL AS product_id
        FROM products
        WHERE MATCH(name, description, category) AGAINST (:term IN NATURAL LANGUAGE MODE)

        UNION

        SELECT
            'variant' AS type,
            v.id,
            p.name AS title,
            NULL AS description,
            p.category,
            v.price,
            v.variant_name,
            v.variant_value,
            v.sku,
            v.product_id
        FROM product_variants v
        JOIN products p ON v.product_id = p.id
        WHERE MATCH(variant_name, variant_value, v.sku) AGAINST (:term IN NATURAL LANGUAGE MODE)
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
        SELECT
            'product' AS type,
            id,
            name AS title,
            description,
            category,
            base_price AS price,
            NULL AS variant_name,
            NULL AS variant_value,
            NULL AS sku,
            NULL AS product_id
        FROM products
        WHERE name LIKE :like OR description LIKE :like OR category LIKE :like

        UNION

        SELECT
            'variant' AS type,
            v.id,
            p.name AS title,
            NULL AS description,
            p.category,
            v.price,
            v.variant_name,
            v.variant_value,
            v.sku,
            v.product_id
        FROM product_variants v
        JOIN products p ON v.product_id = p.id
        WHERE v.variant_name LIKE :like OR v.variant_value LIKE :like OR v.sku LIKE :like
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
