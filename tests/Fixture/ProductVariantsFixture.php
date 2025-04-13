<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductVariantsFixture
 */
class ProductVariantsFixture extends TestFixture
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
                'variant_name' => 'Lorem ipsum dolor sit amet',
                'variant_value' => 'Lorem ipsum dolor sit amet',
                'price' => 1.5,
                'stock_quantity' => 1,
                'sku' => 'Lorem ipsum dolor sit amet',
                'created_at' => '2025-04-13 15:14:18',
            ],
        ];
        parent::init();
    }
}
