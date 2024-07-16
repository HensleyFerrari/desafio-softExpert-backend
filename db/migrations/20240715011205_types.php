<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Types extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('types');
        $table->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('tax', 'integer')
            ->create();
    }
}
