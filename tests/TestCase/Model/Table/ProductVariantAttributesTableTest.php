<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductVariantAttributesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductVariantAttributesTable Test Case
 */
class ProductVariantAttributesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductVariantAttributesTable
     */
    protected $ProductVariantAttributes;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.ProductVariantAttributes',
        'app.ProductVariants',
        'app.AttributeValues',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ProductVariantAttributes') ? [] : ['className' => ProductVariantAttributesTable::class];
        $this->ProductVariantAttributes = $this->getTableLocator()->get('ProductVariantAttributes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ProductVariantAttributes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProductVariantAttributesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ProductVariantAttributesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
