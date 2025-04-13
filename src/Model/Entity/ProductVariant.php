<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProductVariant Entity
 *
 * @property int $id
 * @property int $product_id
 * @property string $variant_name
 * @property string $variant_value
 * @property string $price
 * @property int $stock_quantity
 * @property string $sku
 * @property \Cake\I18n\DateTime $created_at
 *
 * @property \App\Model\Entity\Product $product
 */
class ProductVariant extends Entity
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
        'product_id' => true,
        'variant_name' => true,
        'variant_value' => true,
        'price' => true,
        'stock_quantity' => true,
        'sku' => true,
        'created_at' => true,
        'product' => true,
    ];
}
