<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;

class CustomerController extends Controller
{
    //
    public function index() {
        $customer = Customer::all();

        return view('customers.index', compact('customer'));
    }

    public function create() {
        return view('customers.create');
    }

    public function store(Request $request) {
        
        // dd = die and dump 
        // dd($request->all());

        $request->validate([
            'nama_customer' => 'required',
            'item_customer' => 'required',
            'quantity_customer' => 'required',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index');
            // ->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function edit($id) {
        $customer = Customer::find($id);

        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id) {
        $customer = Customer::find($id);
        $customer->nama_customer = $request->input('nama_customer');
        $customer->item_customer = $request->input('item_customer');
        $customer->quantity_customer = $request->input('quantity_customer');
        $customer->save();

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function delete($id) {
        $cus = Customer::find($id);
        $cus->delete();
        return redirect()->route('customers.index');
    }
}