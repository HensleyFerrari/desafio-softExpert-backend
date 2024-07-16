<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class SaleProducts extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('sale_products');
        $table->addColumn('sale_id', 'integer')
            ->addColumn('product_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->create();
    }
}
