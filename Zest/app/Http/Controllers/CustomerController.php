<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\CustomersExport;
use App\Imports\CustomersImport;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    //
    public function index() {
        $customer = Customer::all();

        return view('customers.index', compact('customer'));
    }

    public function create() {
        return view('customers.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_customer' => 'required',
            'item_customer' => 'required',
            'quantity_customer' => 'required',
        ]);
    
        try {
            Customer::create($request->all());
            return redirect()->route('customers.index')->with('success', 'Customer added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add customer. Please try again.');
        }
    }
    
    public function edit($id) {
        $customer = Customer::find($id);
        return view('customers.edit', compact('customer'));
    }
    
    public function update(Request $request, $id) {
        $customer = Customer::find($id);
        $request->validate([
            'nama_customer' => 'required',
            'item_customer' => 'required',
            'quantity_customer' => 'required',
        ]);
    
        try {
            $customer->update($request->all());
            return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update customer. Please try again.');
        }
    }
    
    public function delete($id) {
        try {
            $cus = Customer::find($id);
            $cus->delete();
            return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete customer. Please try again.');
        }
    }
    
    public function exportPdf() {
        try {
            $customer = Customer::all();
            $pdf = PDF::loadView('customers.exportPdf', compact('customer'));
            return $pdf->download('customer.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to export data to PDF. Please try again.');
        }
    }

    public function exportXls()
    {
        try {
            return Excel::download(new CustomersExport, 'customers.xlsx');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to export data to Excel. Please try again.');
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new CustomersImport, $request->file('file'));
            return redirect()->route('customers.index')->with('success', 'Customer data imported successfully from Excel file.');
        } catch (\Exception $e) {
            // Mengembalikan pesan error kepada pengguna
            return redirect()->back()->with('error', 'Failed to import data from Excel file. Please make sure the file format is correct and try again.');
        }
    }
}