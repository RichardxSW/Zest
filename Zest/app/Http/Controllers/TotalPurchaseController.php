<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\totalpurchase;
use App\Models\Product;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PurchaseExport;
use Maatwebsite\Excel\Facades\Excel;

class TotalPurchaseController extends Controller
{
    // Display a listing of all purchases
    public function index(){
        // Get all purchases, suppliers, and products
        $purchase = totalPurchase::all();
        $supplier = Supplier::all();
        $product = Product::all();

        // Order purchases by creation date in ascending order
        $purchase = totalPurchase::orderBy('created_at', 'asc')->get();

        // Return the index view with the retrieved data
        return view("totalpurchase.index", compact("purchase", "supplier", "product"));
    }

    // Show the form for creating a new purchase
    public function create()
    {
        // Get all suppliers and products
        $supplier = Supplier::all();
        $product = Product::all();

        // Return the create view with the retrieved data
        return view("totalpurchase.create", compact("supplier","product"));
    }

    // Store a newly created purchase in storage
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            "category"=> "required",
            "product_name"=> "required",
            "supplier_name"=> "required",
            "quantity"=> "numeric",
            "in_date"=> "required",
        ]);

        // Normalize supplier name to handle case sensitivity
        $supplierName = strtolower($request->supplier_name);

        // Check if supplier exists with a case-insensitive comparison
        $supplier = Supplier::whereRaw('LOWER(name) = ?', [$supplierName])->first();

        // If supplier does not exist, create a new one
        if (!$supplier) {
            $supplier = Supplier::create([
                'name' => $request->supplier_name,
                'address' => '',
                'email' => '',
                'contact' => '',
            ]);
        }

        try {
            // Create a new purchase with the request data
            totalpurchase::create($request->all());

            // Redirect to the index route with a success message
            return redirect()->route('totalpurchase.index')->with('success', 'Purchase added successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message if creation fails
            return redirect()->back()->with('error', 'Failed to add purchase. Please try again.');
        }
    }

    // Show the form for editing the specified purchase
    public function edit($id)
    {
        // Find the purchase by ID
        $purchase = totalpurchase::find($id);

        // Get all suppliers and products
        $supplier = Supplier::all();
        $product = Product::all();

        // Return the edit view with the retrieved data
        return view('totalpurchase.edit', compact('purchase','supplier', 'product'));
    }

    // Update the specified purchase in storage
    public function update(Request $request, $id)
    {
        // Find the purchase by ID
        $purchase = totalpurchase::find($id);

        // Validate the incoming request data
        $request->validate([
            'category'=> 'required',
            "product_name"=> "required",
            "supplier_name"=> "required",
            "quantity"=> "numeric",
            "in_date"=> "required",
        ]);

        try {
            // Update the purchase with the request data
            $purchase->update($request->all());

            // Redirect to the index route with a success message
            return redirect()->route('totalpurchase.index')->with('success', 'Purchase updated successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message if update fails
            return redirect()->back()->with('error', 'Failed to update purchase. Please try again.');
        }
    }

    // Remove the specified purchase from storage
    public function delete($id) {
        try {
            // Find the purchase by ID and delete it
            $pur = totalpurchase::find($id);
            $pur->delete();

            // Redirect to the index route with a success message
            return redirect()->route('totalpurchase.index')->with('success', 'Purchase deleted successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message if deletion fails
            return redirect()->back()->with('error', 'Failed to delete purchase. Please try again.');
        }
    }

    // Export the list of purchases to a PDF file
    public function exportPdf() {
        try {
            // Get all purchases ordered by creation date
            $purchase = totalpurchase::orderBy('created_at', 'asc')->get();

            // Load the view and generate the PDF
            $pdf = PDF::loadView('totalpurchase.exportPdf', compact('purchase'));

            // Download the generated PDF
            return $pdf->download('purchase.pdf');
        } catch (\Exception $e) {
            // Redirect back with an error message if PDF export fails
            return redirect()->back()->with('error', 'Failed to export data to PDF. Please try again.');
        }
    }

    // Export the list of purchases to an Excel file
    public function exportXls()
    {
        try {
            // Download the generated Excel file using the PurchaseExport class
            return Excel::download(new PurchaseExport, 'purchase.xlsx');
        } catch (\Exception $e) {
            // Redirect back with an error message if Excel export fails
            return redirect()->back()->with('error', 'Failed to export data to Excel. Please try again.');
        }
    }

    // Export a single purchase invoice to a PDF file
    public function exportInv($id)
    {
        // Find the purchase by ID
        $purchase = totalpurchase::findOrFail($id);

        // Load the view and generate the PDF for the invoice
        $pdf = Pdf::loadView('totalpurchase.exportInv', compact('purchase'));

        // Download the generated PDF
        return $pdf->download('invoice.pdf');
    }

    // Display the specified purchase
    public function show($id) {
        // Find the purchase by ID
        $purchase = totalpurchase::find($id);

        // Return the show view with the retrieved data
        return view('totalpurchase.show', compact('purchase'));
    }
}