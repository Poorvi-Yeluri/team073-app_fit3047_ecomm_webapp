<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $session_id
 * @property string|null $customer_name
 * @property string|null $customer_email
 * @property string|null $customer_phone
 * @property string|null $payment_status
 * @property string|null $payment_method
 * @property string $shipping_address
 * @property string|null $billing_address
 * @property float|null $tax_amount
 * @property float|null $shipping_amount
 * @property string|null $currency
 * @property string|null $discounts
 * @property string|null $shipping_method
 * @property string|null $cancel_url
 * @property string|null $success_url
 * @property int|null $expires_at
 * @property \Cake\I18n\FrozenTime|null $created_at
 *
 * @property \App\Model\Entity\User|null $user
 * @property \App\Model\Entity\OrderItem[] $order_items
 */
class Order extends Entity
{
    protected array $_accessible = [
        'user_id' => true,
        'session_id' => true,
        'customer_name' => true,
        'customer_email' => true,
        'customer_phone' => true,
        'payment_status' => true,
        'payment_method' => true,
        'shipping_address' => true,
        'billing_address' => true,
        'tax_amount' => true,
        'shipping_amount' => true,
        'currency' => true,
        'discounts' => true,
        'shipping_method' => true,
        'cancel_url' => true,
        'success_url' => true,
        'expires_at' => true,
        'created_at' => true,
        'user' => true,
        'order_items' => true,
    ];
}
