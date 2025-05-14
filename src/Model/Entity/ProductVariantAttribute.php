<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductVariantAttribute Entity
 *
 * @property int $id
 * @property int $product_variant_id
 * @property int $attribute_value_id
 *
 * @property ProductVariant $product_variant
 * @property AttributeValue $attribute_value
 */
class ProductVariantAttribute extends Entity
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
        'product_variant_id' => true,
        'attribute_value_id' => true,
        'product_variant' => true,
        'attribute_value' => true,
    ];
}
