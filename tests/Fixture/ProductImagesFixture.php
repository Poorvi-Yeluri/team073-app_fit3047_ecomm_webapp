<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductImagesFixture
 */
class ProductImagesFixture extends TestFixture
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
                'product_id' => 1,
                'image_url' => 'Lorem ipsum dolor sit amet',
                'is_main' => 1,
                'created_at' => '2025-04-16 09:29:33',
                'modified_at' => '2025-04-16 09:29:33',
            ],
        ];
        parent::init();
    }
}
