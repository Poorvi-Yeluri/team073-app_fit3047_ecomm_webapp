<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AttributeValues Model
 *
 * @property \App\Model\Table\AttributesTable&\Cake\ORM\Association\BelongsTo $Attributes
 * @property \App\Model\Table\ProductAttributesTable&\Cake\ORM\Association\HasMany $ProductAttributes
 * @property \App\Model\Table\ProductVariantAttributesTable&\Cake\ORM\Association\HasMany $ProductVariantAttributes
 *
 * @method \App\Model\Entity\AttributeValue newEmptyEntity()
 * @method \App\Model\Entity\AttributeValue newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\AttributeValue> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AttributeValue get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\AttributeValue findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\AttributeValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\AttributeValue> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AttributeValue|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\AttributeValue saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\AttributeValue>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AttributeValue>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AttributeValue>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AttributeValue> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AttributeValue>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AttributeValue>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\AttributeValue>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\AttributeValue> deleteManyOrFail(iterable $entities, array $options = [])
 */
class AttributeValuesTable extends Table
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

        $this->setTable('attribute_values');
        $this->setDisplayField('value');
        $this->setPrimaryKey('id');

        $this->belongsTo('Attributes', [
            'foreignKey' => 'attribute_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('ProductAttributes', [
            'foreignKey' => 'attribute_value_id',
        ]);
        $this->hasMany('ProductVariantAttributes', [
            'foreignKey' => 'attribute_value_id',
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
            ->integer('attribute_id')
            ->notEmptyString('attribute_id');

        $validator
            ->scalar('value')
            ->maxLength('value', 255)
            ->requirePresence('value', 'create')
            ->notEmptyString('value');

        $validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('modified_at')
            ->requirePresence('modified_at', 'create')
            ->notEmptyDateTime('modified_at');

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
        $rules->add($rules->isUnique(['attribute_id', 'value']), ['errorField' => 'attribute_id']);
        $rules->add($rules->existsIn(['attribute_id'], 'Attributes'), ['errorField' => 'attribute_id']);

        return $rules;
    }

    public function getValueIdsForFilter(string $attributeName, array $values): array
    {
        return $this->find()
            ->select('AttributeValues.id')
            ->contain(['Attributes'])
            ->where([
                'Attributes.name' => $attributeName,
                'AttributeValues.value IN' => $values
            ])
            ->all()
            ->extract('id')
            ->toList();
    }
}
