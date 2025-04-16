<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateProductVariantImagesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('product_variant_images');
        $table->addColumn('variant_id', 'integer', [
            'null' => false,
        ])
            ->addForeignKey('product_variants', 'id', [ // Corrected to use an array for options
                'onDelete' => 'CASCADE',
                'onUpdate' => 'CASCADE',
            ])
            ->addIndex(['variant_id']);
        $table->addColumn('image_url', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('created_at', 'datetime', [
            'default' => 'CURRENT_TIMESTAMP',
            'null' => false,
        ]);
        $table->addColumn('modified_at', 'datetime', [
            'default' => null,
            'null' => true,
            'update' => 'CURRENT_TIMESTAMP',
        ]);
        $table->create();
    }
}
