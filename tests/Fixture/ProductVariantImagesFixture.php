<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductVariantImagesFixture
 */
class ProductVariantImagesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'variant_id' => 1,
                'image_url' => 'Lorem ipsum dolor sit amet',
                'created_at' => '2025-04-16 09:29:48',
                'modified_at' => '2025-04-16 09:29:48',
            ],
        ];
        parent::init();
    }
}
