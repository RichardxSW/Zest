<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Log;
use App\Exports\CustomersExport;
use App\Imports\CustomersImport;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_customer' => 'required|string|max:255',
            'address_customer' => 'nullable|string|max:255',
            'email_customer' => 'nullable|email|max:255',
            'contact_customer' => 'nullable|string|max:20',
        ]);
    
        try {
            // Save new customer data
            $customer = new Customer();
            $customer->nama_customer = ucwords(strtolower($request->input('nama_customer')));
            $customer->address_customer = ucwords(strtolower($request->input('address_customer')));
            $customer->email_customer = strtolower($request->input('email_customer'));
            $customer->contact_customer = $request->input('contact_customer');
            $customer->save();
    
            return redirect()->route('customers.index')->with('success', 'Customer added successfully.');
        } catch (\Exception $e) {
            // Log the exception message
            Log::error('Failed to add customer: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add customer. Please try again.');
        }
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $request->validate([
            'nama_customer' => 'required|string|max:255',
            'address_customer' => 'nullable|string|max:255',
            'email_customer' => 'nullable|email|max:255',
            'contact_customer' => 'nullable|string|max:20',
        ]);

        try {
            $customer->nama_customer = ucwords(strtolower($request->input('nama_customer')));
            $customer->address_customer = ucwords(strtolower($request->input('address_customer')));
            $customer->email_customer = strtolower($request->input('email_customer'));
            $customer->contact_customer = $request->input('contact_customer');
            $customer->save();
            return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update customer. Please try again.');
        }
    }

    public function delete($id)
    {
        try {
            $customer = Customer::find($id);
            $customer->delete();
            return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete customer. Please try again.');
        }
    }

    public function exportPdf()
    {
        try {
            $customer = Customer::all();
            $pdf = PDF::loadView('customers.exportPdf', compact('customer'));
            return $pdf->download('Customers.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to export data to PDF. Please try again.');
        }
    }

    public function exportXls()
    {
        try {
            return Excel::download(new CustomersExport, 'Customers.xlsx');
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
            return redirect()->back()->with('error', 'Failed to import data from Excel file. Please make sure the file format is correct and try again.');
        }
    }
}