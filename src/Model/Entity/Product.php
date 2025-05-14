<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\I18n\DateTime;
use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $category
 * @property string $base_price
 * @property int $stock_quantity
 * @property DateTime $created_at
 * @property string $image_url
 * @property string $slug
 *
 * @property ProductVariant[] $product_variants
 * @property ProductImage[] $product_images
 * @property string $main_image_url
 * @property array $image_urls
 */
class Product extends Entity
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
        'name' => true,
        'description' => true,
        'category' => true,
        'base_price' => true,
        'stock_quantity' => true,
        'created_at' => true,
        'product_variants' => true,
        'image_url' => true,
        'slug' => true,
    ];

    /**
     * Virtual fields to include in JSON or entity access.
     *
     * @var array<string>
     */
    protected array $_virtual = ['main_image_url', 'image_urls'];

    /**
     * Get the main image URL from product_images where is_main is true.
     *
     * @return string
     */
    protected function _getMainImageUrl(): string
    {
        if (!empty($this->product_images)) {
            foreach ($this->product_images as $img) {
                if ($img->is_main) {
                    return $img->image_url;
                }
            }
        }

        // Fallback if no main image is set
        return $this->image_url;
    }

    /**
     * Get all product image URLs as an array.
     *
     * @return string[]
     */
    protected function _getImageUrls(): array
    {
        if (!empty($this->product_images)) {
            return collection($this->product_images)
                ->map(fn($img) => $img->image_url)
                ->toList();
        }

        return [$this->image_url];
    }
}
