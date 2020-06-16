<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cities = City::all();
        return view('cities.list', compact('cities'));
    }

    public function create()
    {
        return view('cities.create');
    }

    public function store(Request $request)
    {
        $city = new City();
        $city->name = $request->input('name');
        $city->save();
        return redirect()->route('customers.index');
    }

    public function edit($id)
    {
        $city = City::query()->findOrFail($id);
        return view('cities.edit', compact('city'));
    }

    public function update(Request $request, $id)
    {
        $city = City::query()->findOrFail($id);
        $city->name= $request->input('name');
        $city->save();
        return redirect()->route('cities.index');
    }
}
