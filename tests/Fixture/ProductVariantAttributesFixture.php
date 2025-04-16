<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductVariantAttributesFixture
 */
class ProductVariantAttributesFixture extends TestFixture
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
                'product_variant_id' => 1,
                'attribute_value_id' => 1,
            ],
        ];
        parent::init();
    }
}
