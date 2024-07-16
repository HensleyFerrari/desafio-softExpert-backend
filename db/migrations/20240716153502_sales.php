<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Sales extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('sales');
        $table->addColumn('created_at', 'datetime')
            ->create();
    }
}
