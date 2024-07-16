<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesProducts extends Model
{
    protected $table = 'sale_products';
    protected $fillable = [
        'product_id',
        'sale_id',
        'created_at',
    ];
    public $timestamps = false;
}
