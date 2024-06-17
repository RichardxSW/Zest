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

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view("supplier.edit", compact("supplier"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name"=> "required",
            "address"=> "required",
            "email"=> "required",
            "phone"=> "required",
        ]);

        $update = [
            "name"=> $request->name,
            "address"=> $request->address,
            "email"=> $request->email,
            "contact"=> $request->phone
        ];
        Supplier::whereId($id)->update($update);

        return redirect()->route("supplier.index")
            ->with("success","Supplier updated successfully.");
    }

    public function delete($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->route("supplier.index")
            ->with("success","Supplier deleted successfully.");
    }
}
