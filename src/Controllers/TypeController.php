<?php

namespace App\Controllers;

use App\Models\Type;
use App\Http\Controllers\Controller;

class TypeController
{
    public function index()
    {
        return Type::all();
    }

    public function create($data)
    {
        return Type::create([
            'name' => $data['name'],
            'tax' => $data['tax'],
        ]);
    }

    public function show($id)
    {
        return Type::find($id);
    }

    public function update($id, $data)
    {
        $type = Type::find($id);

        if (!$type) {
            return false;
        }

        $type->update([
            'name' => $data['name'] ?? $type->name,
            'tax' => $data['tax'] ?? $type->tax,
        ]);

        return $type;
    }

    public function destroy($id)
    {
        $type = Type::find($id);

        if (!$type) {
            return false;
        }
        return Type::destroy($id);
    }
}
