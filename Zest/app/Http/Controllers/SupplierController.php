<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\supplier;

class SupplierController extends Controller
{
    //index
    public function index()
    {
        $supplier = Supplier::all();

        return view("supplier.index", compact("supplier"));
    }

    //create
    public function create()
    {
        return view("supplier.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name"=> "required",
            "address"=> "required",
            "email"=> "required",
            "phone"=> "required",
        ]);
        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->email = $request->email;
        $supplier->contact = $request->phone;
        $supplier->save();

        return redirect()->route("supplier.index")
            ->with("success","Supplier added successfully.");
    }
}
