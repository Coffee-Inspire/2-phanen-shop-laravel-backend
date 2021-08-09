<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Homepage;

class HomepageController extends Controller
{
    public function index()
    {
        return Homepage::all();
    }

    public function store(Request $request)
    {
        return Homepage::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $homepage = Homepage::findOrFail($id);
        $homepage->update($request->all());

        return $homepage;
    }

    public function delete(Request $request, $id)
    {
        $homepage = Homepage::findOrFail($id);
        $homepage->delete();

        return 204;
    }
}
