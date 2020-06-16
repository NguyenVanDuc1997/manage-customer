<?php

namespace App\Http\Controllers;

use App\City;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use http\Env\Response;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customers = Customer::query()->paginate(2);
        return view('Customers.list', compact('customers'));
    }

    public function create()
    {
        $cities = City::all();
        return view('Customers.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dob');
        $customer->city_id = $request->input('city_id');
        $customer->save();

        Session::flash('success', 'Tao moi khach hang thanh cong');
        return redirect()->route('customers.index');
    }

    public function edit($id)
    {
        $customer = Customer::query()->findOrFail($id);
        $cities = City::all();
        return view('Customers.edit', compact('customer', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::query()->findOrFail($id);
        $customer->name = $request->input('name');
        $customer->email = $request->input('email');
        $customer->dob = $request->input('dob');
        $customer->city_id = $request->input('city_id');
        $customer->save();

        Session::flash('success', 'Chinh sua khach hang thanh cong');
        return redirect()->route('customers.index');
    }

    public function destroy($id)
    {
        $customer = Customer::query()->findOrFail($id);
        $customer->delete();
        Session::flash('success', 'Xoa khach hang thanh cong');
        return redirect()->route('customers.index');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        if (!$keyword) {
            return redirect()->route('customers.index');
        }
        $customers = Customer::where('name', 'LIKE', '%' . $keyword.'%')->paginate(1);
        $cities= City::all();
        return view('Customers.list', compact('customers','cities'));
    }
}
