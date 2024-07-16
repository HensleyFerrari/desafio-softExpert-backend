<?php

namespace App\Controllers;

use App\Models\Sale;

class SaleController
{
    public function create()
    {
        return Sale::create([
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
