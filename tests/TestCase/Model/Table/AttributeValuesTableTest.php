<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttributeValuesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttributeValuesTable Test Case
 */
class AttributeValuesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AttributeValuesTable
     */
    protected $AttributeValues;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.AttributeValues',
        'app.Attributes',
        'app.ProductAttributes',
        'app.ProductVariantAttributes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AttributeValues') ? [] : ['className' => AttributeValuesTable::class];
        $this->AttributeValues = $this->getTableLocator()->get('AttributeValues', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->AttributeValues);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AttributeValuesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\AttributeValuesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
