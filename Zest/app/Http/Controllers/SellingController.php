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
            'quantity' => 'required|integer',
            'date' => 'required|date',
        ]);

        try {
            // Create a new Selling instance and assign the validated data
            $selling = new Selling();
            $selling->product_name = $request->product_name;
            $selling->category_name = $request->category_name;
            $selling->customer_name = $request->customer_name;
            $selling->quantity = $request->quantity;
            $selling->date = $request->date;
            $selling->status = 'pending'; // Default status

            // Save the instance to the database
            $selling->save();

            return redirect()->route('sellings.index')->with('success', 'Selling added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add selling. Please try again.');
        }
    }


    public function edit($id) {
        $selling = Selling::find($id);
        return view('sellings.edit', compact('selling'));
    }

    public function update(Request $request, $id) {
        $selling = Selling::find($id);
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'date' => 'required|date',
            'status' => 'in:pending,approved',
        ]);

        try {
            $selling->update($request->all());
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