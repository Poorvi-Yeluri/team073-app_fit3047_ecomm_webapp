<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderItem Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $variant_id
 * @property string|null $item_description
 * @property int|null $product_id
 * @property float|null $tax_amount
 * @property float|null $amount_subtotal
 * @property float|null $amount_total
 * @property float|null $discount_amount
 * @property int|null $product_variant_id
 * @property int $quantity
 * @property float $price
 *
 * @property Order $order
 * @property Variant $variant
 */
class OrderItem extends Entity
{
    protected array $_accessible = [
        'order_id' => true,
        'variant_id' => true,
        'item_description' => true,
        'product_id' => true,
        'tax_amount' => true,
        'amount_subtotal' => true,
        'amount_total' => true,
        'discount_amount' => true,
        'product_variant_id' => true,
        'quantity' => true,
        'price' => true,
        'order' => true,
        'variant' => true,
    ];
}
