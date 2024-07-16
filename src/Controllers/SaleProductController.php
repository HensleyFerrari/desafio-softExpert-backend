<?php

namespace App\Controllers;

use App\Models\SalesProducts;

class SaleProductController
{
    public function index()
    {
        return SalesProducts::all();
    }
    public function create($data)
    {
        return SalesProducts::create([
            'sale_id' => $data['sale_id'],
            'product_id' => $data['product_id'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
