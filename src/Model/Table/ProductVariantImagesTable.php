<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductVariantImages Model
 *
 * @method \App\Model\Entity\ProductVariantImage newEmptyEntity()
 * @method \App\Model\Entity\ProductVariantImage newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductVariantImage> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductVariantImage get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ProductVariantImage findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ProductVariantImage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ProductVariantImage> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductVariantImage|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ProductVariantImage saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ProductVariantImage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductVariantImage>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductVariantImage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductVariantImage> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductVariantImage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductVariantImage>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ProductVariantImage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ProductVariantImage> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ProductVariantImagesTable extends Table
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

        $this->setTable('product_variant_images');
        $this->setDisplayField('image_url');
        $this->setPrimaryKey('id');
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
            ->integer('variant_id')
            ->requirePresence('variant_id', 'create')
            ->notEmptyString('variant_id');

        $validator
            ->scalar('image_url')
            ->maxLength('image_url', 255)
            ->requirePresence('image_url', 'create')
            ->notEmptyString('image_url');

        $validator
            ->dateTime('created_at')
            ->notEmptyDateTime('created_at');

        $validator
            ->dateTime('modified_at')
            ->allowEmptyDateTime('modified_at');

        return $validator;
    }
}
