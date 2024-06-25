<?php

namespace App\Http\Controllers;

use App\Models\Selling;
use App\Models\Product;
use App\Models\Category;
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
        return view('sellings.index', compact('sellings', 'products', 'categories'));
    }

    public function create() {
        $categories = Category::all();
        $products = Product::all();
        return view('sellings.create', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'date' => 'required|date',
        ]);

        try {
            $selling = new Selling;
            $selling->product_name = ucwords(strtolower($request->input('product_name')));
            $selling->category_name = ucwords(strtolower($request->input('category_name')));
            $selling->customer_name = ucwords(strtolower($request->input('customer_name')));
            $selling->quantity = $request->input('quantity');
            $selling->date = $request->input('date');
            $selling->status = 'pending'; // Default status
            $selling->save();

            return redirect()->route('sellings.index')->with('success', 'Selling added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add selling. Please try again.');
        }
    }

    public function edit($id) {
        $selling = Selling::find($id);
        $categories = Category::all();
        $products = Product::all();
        return view('sellings.edit', compact('selling', 'categories', 'products'));
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
            $selling->product_name = ucwords(strtolower($request->input('product_name')));
            $selling->category_name = ucwords(strtolower($request->input('category_name')));
            $selling->customer_name = ucwords(strtolower($request->input('customer_name')));
            $selling->quantity = $request->input('quantity');
            $selling->date = $request->input('date');

            $selling->save();

            return redirect()->route('sellings.index')->with('success', 'Selling updated successfully.');
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