<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateProductAttributesTable extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('product_attributes');
        $table->addColumn('product_id', 'integer')
            ->addForeignKey('product_id', 'products', 'id', ['delete' => 'CASCADE'])
            ->addColumn('attribute_value_id', 'integer')
            ->addForeignKey('attribute_value_id', 'attribute_values', 'id', ['delete' => 'CASCADE'])
            ->create();
    }
}
