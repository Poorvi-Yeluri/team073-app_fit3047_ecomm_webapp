<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Attributes Model
 *
 * @property \App\Model\Table\AttributeValuesTable&\Cake\ORM\Association\HasMany $AttributeValues
 *
 * @method \App\Model\Entity\Attribute newEmptyEntity()
 * @method \App\Model\Entity\Attribute newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Attribute> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Attribute get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Attribute findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Attribute patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Attribute> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Attribute|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Attribute saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Attribute>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attribute>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Attribute>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attribute> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Attribute>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attribute>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Attribute>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Attribute> deleteManyOrFail(iterable $entities, array $options = [])
 */
class AttributesTable extends Table
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

        $this->setTable('attributes');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('AttributeValues', [
            'foreignKey' => 'attribute_id',
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
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

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
        $rules->add($rules->isUnique(['name']), ['errorField' => 'name']);

        return $rules;
    }

    // In AttributeValuesTable

    /**
     * @param string $attributeName
     * @param array $values
     * @return array
     */
    public function getValueIdsForFilter(string $attributeName, array $values): array
    {
        return $this->find()
            ->contain('Attributes')
            ->where([
                'Attributes.name' => $attributeName,
                'AttributeValues.value IN' => $values
            ])
            ->all()
            ->extract('id')
            ->toList();
    }

}
