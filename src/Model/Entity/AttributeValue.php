<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AttributeValue Entity
 *
 * @property int $id
 * @property int $attribute_id
 * @property string $value
 * @property \Cake\I18n\DateTime $created_at
 * @property \Cake\I18n\DateTime $modified_at
 *
 * @property \App\Model\Entity\Attribute $attribute
 * @property \App\Model\Entity\ProductVariantAttribute[] $product_variant_attributes
 */
class AttributeValue extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'attribute_id' => true,
        'value' => true,
        'created_at' => true,
        'modified_at' => true,
        'attribute' => true,
        'product_variant_attributes' => true,
    ];
}
