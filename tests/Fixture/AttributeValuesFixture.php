<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AttributeValuesFixture
 */
class AttributeValuesFixture extends TestFixture
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
                'attribute_id' => 1,
                'value' => 'Lorem ipsum dolor sit amet',
                'created_at' => '2025-04-15 05:25:43',
                'modified_at' => '2025-04-15 05:25:43',
            ],
        ];
        parent::init();
    }
}
