<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        return Profile::all();
    }

    public function store(Request $request)
    {
        return Profile::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $data = Profile::findOrFail($id);
        $data->update($request->all());

        return $data;
    }

    public function delete(Request $request, $id)
    {
        $data = Profile::findOrFail($id);
        $data->delete();

        return 204;
    }
}
