<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProductCosmetic;

class ProductCosmeticController extends Controller
{
    public function index()
    {
        return ProductCosmetic::all();
    }

    public function store(Request $request)
    {
        return ProductCosmetic::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $data = ProductCosmetic::findOrFail($id);
        $data->update($request->all());

        return $data;
    }

    public function delete(Request $request, $id)
    {
        $data = ProductCosmetic::findOrFail($id);
        $data->delete();

        return 204;
    }
}
