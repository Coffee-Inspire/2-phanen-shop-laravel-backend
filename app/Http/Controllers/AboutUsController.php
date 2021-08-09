<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function index()
    {
        return AboutUs::all();
    }

    public function store(Request $request)
    {
        return AboutUs::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->update($request->all());

        return $aboutUs;
    }

    public function delete(Request $request, $id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->delete();

        return 204;
    }
}
