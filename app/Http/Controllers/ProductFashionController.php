<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProductFashion;

class ProductFashionController extends Controller
{
    public function index()
    {
        return ProductFashion::all();
    }

    public function store(Request $request)
    {
        return ProductFashion::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $data = ProductFashion::findOrFail($id);
        $data->update($request->all());

        return $data;
    }

    public function delete(Request $request, $id)
    {
        $data = ProductFashion::findOrFail($id);
        $data->delete();

        return 204;
    }
}
