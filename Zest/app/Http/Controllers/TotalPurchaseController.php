<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\totalpurchase;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PurchaseExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class TotalPurchaseController extends Controller
{
    // Display a listing of all purchases
    public function index(){
        // Retrieve all products, categories, suppliers, and purchases
        $products = Product::all();
        $categories = Category::all();
        $supplier = Supplier::all();
        $purchase = totalPurchase::orderBy('created_at', 'asc')->get();

        // Return the index view with the retrieved data
        return view("totalpurchase.index", compact("purchase", "categories", "products", "supplier"));
    }

    // Show the form for creating a new purchase
    public function create()
    {
        // Retrieve all products, categories, and suppliers
        $products = Product::all();
        $categories = Category::all();
        $suppliers = Supplier::all();

        // Return the create view with the retrieved data
        return view("totalpurchase.create", compact("categories","products", "suppliers"));
    }

    // Store a newly created purchase in storage
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            "category"=> "required",
            "product_name"=> "required",
            'supplier_name_select' => 'nullable|string|max:255',
            'supplier_name_input' => 'nullable|string|max:255',
            "quantity"=> "numeric|min:1",
            "in_date"=> "required",
        ]);

        try {
            // Determine which supplier name to use
            $supplier_name = $request->input('supplier_name_select') ?: $request->input('supplier_name_input');

            if (!$supplier_name) {
                return redirect()->back()->with('error', 'Supplier name is required.');
            }

            // Normalize supplier name to handle case sensitivity
            $supplierNameNormalized = strtolower($supplier_name);

            // Check if supplier exists with a case-insensitive comparison
            $supplier = Supplier::whereRaw('LOWER(name) = ?', [$supplierNameNormalized])->first();

            // If supplier does not exist, create a new one
            if (!$supplier) {
                $supplier = Supplier::create([
                    'name' => ucwords(strtolower($supplier_name)),
                    'address' => '',
                    'email' => '',
                    'contact' => '',
                ]);
            }
            
            // Create a new purchase
            $purchase = new totalPurchase;
            $purchase->product_name = ucwords(strtolower($request->input('product_name')));
            $purchase->category = ucwords(strtolower($request->input('category')));
            $purchase->supplier_name = ucwords(strtolower($supplier_name));
            $purchase->quantity = $request->input('quantity');
            $purchase->in_date = $request->input('in_date');
            $purchase->status = 'pending'; // Default status
            $purchase->save();
            
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

        // Retrieve all products, categories, and suppliers
        $products = Product::all();
        $categories = Category::all();
        $suppliers = Supplier::all();

        // Return the edit view with the retrieved data
        return view('totalpurchase.edit', compact('purchase','categories', 'products', 'suppliers'));
    }

    // Update the specified purchase in storage
    public function update(Request $request, $id)
    {
        // Find the purchase by ID
        $purchase = totalpurchase::find($id);

        if (!$purchase) {
            return redirect()->route('totalpurchase.index')->with('error', 'Purchase record not found.');
        }

        // Validate the incoming request data
        $request->validate([
            'category'=> 'required',
            "product_name"=> "required",
            "supplier_name"=> "required",
            "quantity"=> "numeric|min:1",
            "in_date"=> "required",
        ]);

        try {
            // Check if the old supplier name exists in the Supplier model
            $oldSupplier = Supplier::whereRaw('LOWER(name) = ?', [strtolower($purchase->supplier_name)])->first();

            // If old supplier exists, update its name to the new name
            if ($oldSupplier) {
                $oldSupplier->name = ucwords(strtolower($request->input('supplier_name')));
                $oldSupplier->save();
            }
            
            // Update purchase details
            $purchase->product_name = ucwords(strtolower($request->input('product_name')));
            $purchase->category = ucwords(strtolower($request->input('category')));
            $purchase->supplier_name = ucwords(strtolower($request->input('supplier_name')));
            $purchase->quantity = $request->input('quantity');
            $purchase->in_date = $request->input('in_date');

            $purchase->save();

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
    public function exportReceipt($id)
    {
        try {
            // Find the purchase by ID
            $purchase = totalpurchase::findOrFail($id);

            // Get product data from database
            $product = Product::where('nama_produk', $purchase->product_name)->first();

            // Load the view and pass purchase and product data
            $pdf = PDF::loadView('totalpurchase.exportReceipt', compact('purchase', 'product'));

            // Download the generated PDF
            return $pdf->download('receipt.pdf');
        } catch (\Exception $e) {
            // Handle errors if purchase is not found or other exceptions
            return redirect()->back()->with('error', 'Failed to generate receipt. Please try again.');
        }
    }

    // Display the specified purchase
    public function show($id) {
        // Find the purchase by ID
        $purchase = totalpurchase::find($id);

        // Return the show view with the retrieved data
        return view('totalpurchase.show', compact('purchase'));
    }
}