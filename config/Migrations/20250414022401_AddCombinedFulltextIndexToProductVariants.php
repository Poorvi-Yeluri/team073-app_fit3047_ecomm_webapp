<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddCombinedFulltextIndexToProductVariants extends BaseMigration
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
        $table = $this->table('product_variants');
        $table->addIndex(
            ['variant_name', 'variant_value', 'sku'],
            [
                'type' => 'fulltext',
                'name' => 'fulltext_variant_sku'
            ]
        );
        $table->update();
    }
}
