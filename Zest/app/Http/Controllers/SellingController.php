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
use Carbon\Carbon;

class SellingController extends Controller
{
    public function index() {
        $sellings = Selling::all();
        $products = Product::all();
        $categories = Category::all();
        $customers = Customer::all();

        return view('sellings.index', compact(
            'sellings', 
            'products', 
            'categories', 
            'customers',
        ));
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

            return redirect()->route('sellings.index')->with('success', 'Selling added successfully.');
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
            // Update the selling record
            $selling->product_name = ucwords(strtolower($request->input('product_name')));
            $selling->category_name = ucwords(strtolower($request->input('category_name')));
            // Optionally, you can skip updating customer_name here to maintain the existing customer association
            $selling->customer_name = ucwords(strtolower($request->input('customer_name')));
            $selling->quantity = $request->input('quantity');
            $selling->date = $request->input('date');
            $selling->status = $selling->status; // Ensure status remains unchanged
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

    // public function show($id) {
    //     $selling = Selling::find($id);
    //     return view('sellings.show', compact('selling'));
    // }

    public function dailySales(Request $request)
    {
         // Daily Sales
         $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
         $endDate = $request->input('end_date', Carbon::now()->toDateString());
         
         $dailySales = Selling::where('status', 'approved')
                         ->whereBetween('updated_at', [$startDate, $endDate])
                         ->get();
 
        // Total Sales per Product sorted by quantity descending
        $totalDailySales = $dailySales->groupBy('product_name')->map(function ($rows) {
            return $rows->sum('quantity');
        });

         $totalDailySalesPerCategory = $dailySales->groupBy('category_name')->map(function ($row) {
            return $row->sum('quantity');
        });

        return view('sellings.dailySales', compact('dailySales', 'startDate', 'endDate', 'totalDailySales', 'totalDailySalesPerCategory'));
    }

    public function monthlySales(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        $startDate = Carbon::create($year, $month)->startOfMonth();
        $endDate = Carbon::create($year, $month)->endOfMonth();
        
        $monthlySales = Selling::where('status', 'approved')
                        ->whereBetween('updated_at', [$startDate, $endDate])
                        ->get();

        $totalMonthlySales = $monthlySales->groupBy('product_name')->map(function ($row) {
            return $row->sum('quantity');
        });

        $totalMonthlySalesPerCategory = $monthlySales->groupBy('category_name')->map(function ($row) {
            return $row->sum('quantity');
        });

        return view('sellings.monthlySales', compact('monthlySales', 'month', 'year', 'totalMonthlySales', 'totalMonthlySalesPerCategory'));
    }
}