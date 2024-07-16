<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Product extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('products');
        $table->addColumn('name', 'string', ['limit' => 255])
            ->addColumn('description', 'text')
            ->addColumn('price', 'decimal', ['precision' => 10, 'scale' => 2])
            ->addColumn('type', 'integer')
            ->create();
    }
}
