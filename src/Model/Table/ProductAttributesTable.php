<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductAttributes Model
 *
 * @property \App\Model\Table\ProductsTable&\Cake\ORM\Association\BelongsTo $Products
 * @property \App\Model\Table\AttributeValuesTable&\Cake\ORM\Association\BelongsTo $AttributeValues
 *
 * @method \App\Model\Entity\ProductAttribute newEmptyEntity()
 * @method \App\Model\Entity\ProductAttribute newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductAttribute> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductAttribute get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ProductAttribute findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ProductAttribute patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductAttribute> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductAttribute|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ProductAttribute saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ProductAttribute>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductAttribute>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductAttribute>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductAttribute> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductAttribute>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductAttribute>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductAttribute>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductAttribute> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProductAttributesTable extends Table
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

        $this->setTable('product_attributes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Products', [
            'foreignKey' => 'product_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('AttributeValues', [
            'foreignKey' => 'attribute_value_id',
            'joinType' => 'INNER',
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
            ->notEmptyString('product_id');

        $validator
            ->integer('attribute_value_id')
            ->notEmptyString('attribute_value_id');

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
        $rules->add($rules->existsIn(['product_id'], 'Products'), ['errorField' => 'product_id']);
        $rules->add($rules->existsIn(['attribute_value_id'], 'AttributeValues'), ['errorField' => 'attribute_value_id']);

        return $rules;
    }
}
