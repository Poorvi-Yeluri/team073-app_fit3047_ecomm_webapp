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
 * @property string $price
 * @property string $slug
 * @property int $stock_quantity
 * @property string $sku
 * @property DateTime $created_at
 *
 * @property Product $product
 * @property ProductVariantImage[] $product_variant_images
 * @property string $main_image_url
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
        'slug' => true,
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

    protected array $_virtual = ['main_image_url', 'image_urls'];

    /**
     * Get the main image URL from product variant images where is_main is true.
     *
     * @return string
     */
    protected function _getMainImageUrl(): string
    {
        if (!empty($this->product_variant_images)) {
            foreach ($this->product_variant_images as $img) {
                if ($img->is_main) {
                    return $img->image_url;
                }
            }
        }

        // Fallback if no main image is set
        return "https://picsum.photos/500/500";
    }


    /**
     * Get all product variant image URLs as an array.
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
