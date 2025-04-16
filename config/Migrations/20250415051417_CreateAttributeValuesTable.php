<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateAttributeValuesTable extends BaseMigration
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
        $table = $this->table('attribute_values');
        $table->addColumn('attribute_id', 'integer')
            ->addForeignKey('attribute_id', 'attributes', 'id', ['delete' => 'CASCADE'])
            ->addColumn('value', 'string', ['limit' => 255])
            ->addIndex(['attribute_id', 'value'], ['unique' => true])
            ->addColumn('created_at', 'datetime')
            ->addColumn('modified_at', 'datetime')
            ->create();
    }
}
