<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SupplierExport;
use App\Imports\SupplierImport;
use Maatwebsite\Excel\Facades\Excel;

class SupplierController extends Controller
{
    // Display a listing of all suppliers
    public function index()
    {
        // Get all suppliers ordered by creation date in ascending order
        $supplier = Supplier::orderBy('created_at', 'asc')->get();

        // Return the index view with the retrieved data
        return view("supplier.index", compact("supplier"));
    }

    // Show the form for creating a new supplier
    public function create()
    {
        // Return the create view
        return view("supplier.create");
    }

    // Store a newly created supplier in storage
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            "name" => "required",
            "address" => "required",
            "email" => "required",
            "contact" => "required",
        ]);

        try {
            // Create a new supplier with the request data
            Supplier::create($request->all());

            // Redirect to the index route with a success message
            return redirect()->route('supplier.index')->with('success', 'Supplier added successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message if creation fails
            return redirect()->back()->with('error', 'Failed to add supplier. Please try again.');
        }
    }

    // Show the form for editing the specified supplier
    public function edit($id)
    {
        // Find the supplier by ID
        $supplier = Supplier::find($id);

        // Return the edit view with the retrieved data
        return view("supplier.edit", compact("supplier"));
    }

    // Update the specified supplier in storage
    public function update(Request $request, $id)
    {
        // Find the supplier by ID
        $supplier = supplier::find($id);

        // Validate the incoming request data
        $request->validate([
            "name" => "required",
            "address" => "required",
            "email" => "required",
            "contact" => "required",
        ]);

        try {
            // Update the supplier with the request data
            $supplier->update($request->all());

            // Redirect to the index route with a success message
            return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message if update fails
            return redirect()->back()->with('error', 'Failed to update supplier. Please try again.');
        }
    }

    // Remove the specified supplier from storage
    public function delete($id)
    {
        try {
            // Find the supplier by ID and delete it
            $sup = Supplier::find($id);
            $sup->delete();

            // Redirect to the index route with a success message
            return redirect()->route('supplier.index')->with('success', 'Supplier deleted successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message if deletion fails
            return redirect()->back()->with('error', 'Failed to delete supplier. Please try again.');
        }
    }

    // Export the list of suppliers to a PDF file
    public function exportPdf() {
        try {
            // Get all suppliers ordered by creation date
            $supplier = Supplier::orderBy('created_at', 'asc')->get();

            // Load the view and generate the PDF
            $pdf = PDF::loadView('supplier.exportPdf', compact('supplier'));

            // Download the generated PDF
            return $pdf->download('supplier.pdf');
        } catch (\Exception $e) {
            // Redirect back with an error message if PDF export fails
            return redirect()->back()->with('error', 'Failed to export data to PDF. Please try again.');
        }
    }

    // Export the list of suppliers to an Excel file
    public function exportXls()
    {
        try {
            // Download the generated Excel file using the SupplierExport class
            return Excel::download(new SupplierExport, 'supplier.xlsx');
        } catch (\Exception $e) {
            // Redirect back with an error message if Excel export fails
            return redirect()->back()->with('error', 'Failed to export data to Excel. Please try again.');
        }
    }

    // Import supplier data from an Excel file
    public function import(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            // Import the data from the uploaded file using the SupplierImport class
            Excel::import(new SupplierImport, $request->file('file'));

            // Redirect to the index route with a success message
            return redirect()->route('supplier.index')->with('success', 'Supplier data imported successfully from Excel file.');
        } catch (\Exception $e) {
            // Redirect back with an error message if import fails
            return redirect()->back()->with('error', 'Failed to import data from Excel file. Please make sure the file format is correct and try again.');
        }
    }
}