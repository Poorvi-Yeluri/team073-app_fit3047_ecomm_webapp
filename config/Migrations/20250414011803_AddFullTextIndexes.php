<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddFullTextIndexes extends BaseMigration
{
    public function up(): void
    {
        // Add FULLTEXT index for products table
        $this->table('products')
            ->addIndex(['name', 'description', 'category'], ['type' => 'fulltext'])
            ->update();

        // Add FULLTEXT index for product_variants table
        $this->table('product_variants')
            ->addIndex(['variant_name', 'variant_value'], ['type' => 'fulltext'])
            ->update();
    }

    public function down(): void
    {
        // Remove FULLTEXT index for products table
        $this->table('products')
            ->removeIndex(['name', 'description', 'category'])
            ->update();

        // Remove FULLTEXT index for product_variants table
        $this->table('product_variants')
            ->removeIndex(['variant_name', 'variant_value'])
            ->update();
    }
}
