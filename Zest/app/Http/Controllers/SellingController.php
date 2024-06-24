<?php

namespace App\Http\Controllers;

use App\Models\Selling;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SellingExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class SellingController extends Controller
{
    public function index() {
        $sellings = Selling::all();
        return view('sellings.index', compact('sellings'));
    }

    public function create() {
        return view('sellings.create');
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
            // Check if the selling entry already exists with the same product, category, and customer names
            $selling = Selling::where('product_name', ucwords(strtolower($request->input('product_name'))))
                                ->where('category_name', ucwords(strtolower($request->input('category_name'))))
                                ->where('customer_name', ucwords(strtolower($request->input('customer_name'))))
                                ->where('date', $request->input('date'))
                                ->first();

            if ($selling) {
                // If entry exists, update the quantity
                $selling->quantity += $request->input('quantity');
                $selling->save();
            } else {
                // If entry doesn't exist, create a new one
                $selling = new Selling();
                $selling->product_name = ucwords(strtolower($request->input('product_name')));
                $selling->category_name = ucwords(strtolower($request->input('category_name')));
                $selling->customer_name = ucwords(strtolower($request->input('customer_name')));
                $selling->quantity = $request->input('quantity');
                $selling->date = $request->input('date');
                $selling->status = 'pending'; // Default status
                $selling->save();
            }

            return redirect()->route('sellings.index')->with('success', 'Selling added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add selling. Please try again.');
        }
    }

    public function edit($id) {
        $selling = Selling::find($id);
        return view('sellings.edit', compact('selling'));
    }

    public function update(Request $request, $id)
    {
        $selling = Selling::find($id);
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'date' => 'required|date',
            // 'status' => 'in:pending,approved',
        ]);

        try {
            // Check if there is any other selling entry with the same product, category, and customer names
            $existingSelling = Selling::where('id', '!=', $id)
                                        ->where('product_name', ucwords(strtolower($request->input('product_name'))))
                                        ->where('category_name', ucwords(strtolower($request->input('category_name'))))
                                        ->where('customer_name', ucwords(strtolower($request->input('customer_name'))))
                                        ->where('date', $request->input('date'))
                                        ->first();

            if ($existingSelling) {
                // If entry exists, update the quantity
                $existingSelling->quantity += $request->input('quantity');
                $existingSelling->save();
                // Delete the current selling instance as it's merged with an existing one
                $selling->delete();
            } else {
                // If entry doesn't exist, update the current selling instance
                $selling->product_name = ucwords(strtolower($request->input('product_name')));
                $selling->category_name = ucwords(strtolower($request->input('category_name')));
                $selling->customer_name = ucwords(strtolower($request->input('customer_name')));
                $selling->quantity = $request->input('quantity');
                $selling->date = $request->input('date');
                $selling->status = $request->input('status');
                $selling->save();
            }

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