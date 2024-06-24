<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\CustomersExport;
use App\Imports\CustomersImport;
use Maatwebsite\Excel\Facades\Excel;

class SupplierController extends Controller
{
    //index
    public function index()
    {
        $supplier = Supplier::all();
        $supplier = Supplier::orderBy('created_at', 'asc')->get();
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

    public function search(Request $request)
    {
        $query = $request->input('query');

        $supplier = Supplier::query()
            ->where('name', 'ILIKE', '%' . $query . '%')
            ->orWhere('address', 'ILIKE', '%' . $query . '%')
            ->orWhere('email', 'ILIKE', '%' . $query . '%')
            ->orWhere('contact', 'ILIKE', '%' . $query . '%')
            ->get();

        return view("supplier.index", compact("supplier"));
    }
}
