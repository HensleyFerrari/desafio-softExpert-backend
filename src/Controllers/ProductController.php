<?php

namespace App\Controllers;

use App\Models\Product;

class ProductController
{
    public function index()
    {
        return Product::all();
    }

    public function create($data)
    {
        return Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'type' => $data['type'],
        ]);
    }

    public function show($id)
    {
        return Product::find($id);
    }

    public function update($id, $data)
    {
        $product = Product::find($id);

        if (!$product) {
            return false;
        }

        $product->update([
            'name' => $data['name'] ?? $product->name,
            'description' => $data['description'] ?? $product->description,
            'price' => $data['price'] ?? $product->price,
            'type' => $data['type'] ?? $product->type,
        ]);

        return $product;
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return false;
        }
        return Product::destroy($id);
    }
}
