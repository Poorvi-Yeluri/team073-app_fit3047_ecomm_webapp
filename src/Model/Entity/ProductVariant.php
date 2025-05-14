<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\I18n\DateTime;
use Cake\ORM\Entity;

/**
 * ProductVariant Entity
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property string $variant_value
 * @property string $price
 * @property int $stock_quantity
 * @property string $sku
 * @property DateTime $created_at
 *
 * @property Product $product
 * @property ProductVariantImage[] $product_variant_images
 * @property array $image_urls
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
        'name' => true,
        'variant_value' => true,
        'price' => true,
        'stock_quantity' => true,
        'sku' => true,
        'created_at' => true,
        'product' => true,
    ];


    /**
     * Virtual fields to include in JSON or entity access.
     *
     * @var array<string>
     */
    protected array $_virtual = ['image_urls'];



    /**
     * Get all product image URLs as an array.
     *
     * @return string[]
     */
    protected function _getImageUrls(): array
    {
        if (!empty($this->product_variant_images)) {
            return collection($this->product_variant_images)
                ->map(fn($img) => $img->image_url)
                ->toList();
        }

        return [];
    }
}
