<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('pages.contact', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email|unique:customers,email',
        ]);

        Customer::create($request->only('name', 'email'));

        return redirect()->back()->with('success', 'Customer created!');
    }
}
