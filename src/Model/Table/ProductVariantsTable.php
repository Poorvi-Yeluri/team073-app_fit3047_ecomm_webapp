<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\ProductVariant;
use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

/**
 * ProductVariants Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 *
 * @method \App\Model\Entity\ProductVariant newEmptyEntity()
 * @method \App\Model\Entity\ProductVariant newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductVariant> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductVariant get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ProductVariant findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ProductVariant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductVariant> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductVariant|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ProductVariant saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ProductVariant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductVariant>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductVariant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductVariant> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductVariant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductVariant>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductVariant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductVariant> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProductVariantsTable extends Table
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

        $this->setTable('product_variants');
        $this->setDisplayField('variant_name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('ProductVariantAttributes', [
            'foreignKey' => 'product_variant_id',
            'joinType' => 'INNER',
        ]);

        $this->hasMany('ProductVariantImages', [
            'foreignKey' => 'variant_id',
            'joinType' => 'INNER',
        ]);

        $this->belongsToMany('AttributeValues', [
            'through' => 'ProductVariantAttributes',
            'foreignKey' => 'product_variant_id',
            'targetForeignKey' => 'attribute_value_id',
            'propertyName' => 'variant_attribute_values',
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
            ->integer('product_id')
            ->requirePresence('product_id', 'create', 'Product ID is required')
            ->notEmptyString('product_id', 'Product ID is required');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->integer('stock_quantity')
            ->requirePresence('stock_quantity', 'create')
            ->notEmptyString('stock_quantity');

        $validator
            ->scalar('sku')
            ->maxLength('sku', 255)
            ->requirePresence('sku', 'create')
            ->notEmptyString('sku')
            ->add('sku', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['sku']), ['errorField' => 'sku']);
        $rules->add($rules->existsIn(['product_id'], 'Products'), ['errorField' => 'product_id']);

        return $rules;
    }

    /**
     * @param EventInterface $event
     * @param ProductVariant $entity
     * @param ArrayObject $options
     * @return void
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {
        if ($entity->isNew() && !$entity->slug) {
            $slugBase = strtolower(Text::slug($entity->name));
            if (empty($slugBase)) {
                $slugBase = $entity->sku;
            }

            $slug = substr($slugBase, 0, 191);
            $counter = 1;

            $conditions = ['slug' => $slug];

            while ($this->exists($conditions)) {
                $slug = substr($slugBase . '-' . $counter++, 0, 191);
                $conditions['slug'] = $slug;
            }
            $entity->slug = $slug;
        }
    }

    public function findBySlug(string $slug): ProductVariant
    {
        return $this->find()
            ->where(['ProductVariants.slug' => $slug])
            ->contain([
                'Products',
                'ProductVariantImages',
                'ProductVariantAttributes.AttributeValues.Attributes',
            ])
            ->firstOrFail();
    }
}
