<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddImageUrlToProducts extends AbstractMigration
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
        $table = $this->table('product_images');
        $table->addColumn('product_id', 'integer', [
            'null' => false,
        ])
            ->addForeignKey('products', 'id', [
                'onDelete' => 'CASCADE',
                'onUpdate' => 'CASCADE'
            ])
            ->addIndex(['product_id']);
        $table->addColumn('image_url', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('is_main', 'boolean', [
            'default' => false,
            'null' => false,
            'comment' => 'Indicates if this is the main product image',
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
