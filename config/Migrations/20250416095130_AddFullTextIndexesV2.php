<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class AddFulltextIndexesV2 extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('products');
        $table->addIndex(['name', 'description', 'category'], [
            'name' => 'products_fulltext',
            'type' => 'fulltext'
        ]);
        $table->update();

        $table = $this->table('product_variants');
        $table->addIndex(['sku'], [
            'name' => 'product_variants_fulltext',
            'type' => 'fulltext'
        ]);
        $table->update();
    }
}
