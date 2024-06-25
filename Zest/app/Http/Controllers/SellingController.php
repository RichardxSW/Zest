<?php

namespace App\Http\Controllers;

use App\Models\Selling;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SellingExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class SellingController extends Controller
{
    public function index() {
        $sellings = Selling::all();
        $products = Product::all();
        $categories = Category::all();
        $customers = Customer::all();
        return view('sellings.index', compact('sellings', 'products', 'categories', 'customers'));
    }

    public function create() {
        $categories = Category::all();
        $products = Product::all();
        $customers = Customer::all();
        return view('sellings.create', compact('categories', 'products','customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'customer_name_select' => 'nullable|string|max:255',
            'customer_name_input' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:0',
            'date' => 'required|date',
        ]);

        try {
            // Determine which customer name to use
            $customer_name = $request->input('customer_name_select') ?: $request->input('customer_name_input');

            if (!$customer_name) {
                return redirect()->back()->with('error', 'Customer name is required.');
            }

            // Adding selling record
            $selling = new Selling;
            $selling->product_name = ucwords(strtolower($request->input('product_name')));
            $selling->category_name = ucwords(strtolower($request->input('category_name')));
            $selling->customer_name = ucwords(strtolower($customer_name));
            $selling->quantity = $request->input('quantity');
            $selling->date = $request->input('date');
            $selling->status = 'pending'; // Default status
            $selling->save();

            // Check if the customer is new and add if necessary
            if ($request->input('customer_name_input')) {
                $customer = new Customer;
                $customer->nama_customer = ucwords(strtolower($customer_name));
                $customer->save();
            }

            return redirect()->route('sellings.index')->with('success', 'Selling and Customer added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add selling. Please try again.');
        }
    }

    public function edit($id) {
        $selling = Selling::find($id);
        $categories = Category::all();
        $products = Product::all();
        $customers = Customer::all();
        return view('sellings.edit', compact('selling', 'customers', 'categories', 'products'));
    }

    public function update(Request $request, $id)
    {
        $selling = Selling::find($id);

        if (!$selling) {
            return redirect()->route('sellings.index')->with('error', 'Selling record not found.');
        }

        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'date' => 'required|date',
        ]);

        try {
            // Store the old customer name before updating the selling record
            $oldCustomerName = $selling->customer_name;

            // Update the selling record
            $selling->product_name = ucwords(strtolower($request->input('product_name')));
            $selling->category_name = ucwords(strtolower($request->input('category_name')));
            $selling->customer_name = ucwords(strtolower($request->input('customer_name')));
            $selling->quantity = $request->input('quantity');
            $selling->date = $request->input('date');
            $selling->status = $selling->status;
            $selling->save();

            // Update the customer record
            $customer = Customer::where('nama_customer', ucwords(strtolower($oldCustomerName)))->first();
            if ($customer) {
                $customer->nama_customer = ucwords(strtolower($request->input('customer_name')));
                $customer->save();

                // Update all related sellings with the new customer name
                Selling::where('customer_name', $oldCustomerName)
                    ->update(['customer_name' => $request->input('customer_name')]);
            } else {
                // Handle the case where the customer does not exist, if necessary
                return redirect()->route('sellings.index')->with('error', 'Customer record not found.');
            }

            return redirect()->route('sellings.index')->with('success', 'Selling and customer updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update selling. Please try again.');
        }
    }

    public function delete($id) {
        try {
            $selling = Selling::find($id);
            $selling->delete();
            return redirect()->route('sellings.index')->with('success', 'Selling deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete selling. Please try again.');
        }
    }

    public function exportPdf() {
        try {
            $sellings = Selling::all();
            $pdf = PDF::loadView('sellings.exportPdf', compact('sellings'));
            return $pdf->download('sellings.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to export data to PDF. Please try again.');
        }
    }

    public function exportXls() {
        try {
            return Excel::download(new SellingExport, 'sellings.xlsx');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to export data to Excel. Please try again.');
        }
    }

    public function exportInv($id)
    {
        $selling = Selling::findOrFail($id);
        $pdf = Pdf::loadView('sellings.exportInv', compact('selling'));
        return $pdf->download('invoice.pdf');
    }

    public function show($id) {
        $selling = Selling::find($id);
        return view('sellings.show', compact('selling'));
    }
}