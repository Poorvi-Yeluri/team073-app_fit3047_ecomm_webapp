<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class ModifyProductVariantsTable extends BaseMigration
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
        $table->removeColumn('variant_name');
        $table->removeColumn('variant_value');
        $table->addColumn('modified_at', 'datetime', ['null' => true, 'after' => 'created_at']); // Optional: Add modified_at
        $table->update();
    }
}
