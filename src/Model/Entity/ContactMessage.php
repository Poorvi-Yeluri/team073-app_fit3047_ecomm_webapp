<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ContactMessage Entity
 *
 * @property int $id
 * @property string $message_type
 * @property string $description
 * @property string $customer_name
 * @property string $customer_email
 * @property string $customer_phone
 * @property \Cake\I18n\DateTime|null $created_at
 */
class ContactMessage extends Entity
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
        'message_type' => true,
        'description' => true,
        'customer_name' => true,
        'customer_email' => true,
        'customer_phone' => true,
        'created_at' => true,
    ];
}
