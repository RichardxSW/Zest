<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SupplierExport;
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

        try {
            Supplier::create($request->all());
            return redirect()->route('supplier.index')->with('success', 'Suppier added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add supplier. Please try again.');
        }
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view("supplier.edit", compact("supplier"));
    }

    public function update(Request $request, $id)
    {
        $supplier = supplier::find($id);

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

        try {
            $supplier->update($request->all());
            return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update supplier. Please try again.');
        }
    }

    public function delete($id)
    {
        try {
            $sup = Supplier::find($id);
            $sup->delete();
            return redirect()->route('supplier.index')->with('success', 'Supplier deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete supplier. Please try again.');
        }
    }

    public function exportPdf() {
        try {
            $supplier = supplier::all();
            $pdf = PDF::loadView('supplier.exportPdf', compact('supplier'));
            return $pdf->download('supplier.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to export data to PDF. Please try again.');
        }
    }

    public function exportXls()
    {
        try {
            return Excel::download(new SupplierExport, 'supplier.xlsx');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to export data to Excel. Please try again.');
        }
    }
}
