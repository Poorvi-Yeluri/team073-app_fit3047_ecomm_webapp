<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateAttributesTable extends BaseMigration
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
        $table = $this->table('attributes');
        $table->addColumn('name', 'string', ['limit' => 255])
            ->addIndex(['name'], ['unique' => true])
            ->addColumn('created_at', 'datetime')
            ->addColumn('modified_at', 'datetime')
            ->create();
    }
}
