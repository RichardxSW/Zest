<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Selling;
use App\Models\totalpurchase;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    // Function to display the products list
    public function index() {
        $selling = Selling::all();
        $customer = Customer::all();
        $purchase = totalPurchase::all();
        $product = Product::orderBy('created_at', 'asc')->get(); 
        $category = Category::all(); 
        $pendingRequestPurchase = totalPurchase::where('status', 'pending')->count();
        $pendingRequestSell = Selling::where('status', 'pending')->count();
        return view('products.index', compact(
            'product', 
            'category', 
            'selling', 
            'purchase', 
            'pendingRequestPurchase', 
            'pendingRequestSell'
            ));
    }

    // Function to display the add product form
    public function create() {
        $categories = Category::with('products')->get(); 
        return view('products.create', compact('categories'));
    }

    // Function to store the product data
    public function store(Request $request) {
        
        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'jumlah_produk' => 'numeric',
            'kategori_produk' => 'required',
        ]);

        // Menyimpan data produk ke database
        $product = new Product;
        $product->nama_produk = ucwords(strtolower($request->input('nama_produk')));
        $product->harga_produk = $request->harga_produk;
        $product->jumlah_produk = $request->jumlah_produk;
        $product->kategori_produk = $request->kategori_produk;
        $product->save();

        $this->updateCategoryCount($product->kategori_produk);
        $this->updateTotalProductCount($product->kategori_produk);

        return redirect()->route('products.index')
            ->with('success', 'Product added successfully');
    }

    // Function to display the edit product form
    public function edit($id) {
        $pro = Product::find($id);
        return view('products.edit', compact('product'));
    }

    // Function to update the product data
    public function update($id, Request $request) {

        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'numeric',
            'jumlah_produk' => 'numeric',
            'kategori_produk' => 'required',
        ]);
    
        $product = Product::findOrFail($id);
        $oldCategory = $product->kategori_produk;
    
        $update = [
            'nama_produk' => ucwords(strtolower($request->input('nama_produk'))),
            'harga_produk' => $request->harga_produk,
            'jumlah_produk' => $request->jumlah_produk,
            'kategori_produk' => $request->kategori_produk,
        ];
    
        $product->update($update);
        $this->updateCategoryCount($oldCategory);
        $this->updateCategoryCount($request->kategori_produk);
        $this->updateTotalProductCount($oldCategory);
        $this->updateTotalProductCount($request->kategori_produk);
    
        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }    

    // Function to delete the product data
    public function delete($id) {
        $product = Product::find($id);
        $category = $product->kategori_produk;
        $product->delete();
        $this->updateCategoryCount($category);
        $this->updateTotalProductCount($category);

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }

    // Function to update the category count
    private function updateCategoryCount($categoryName) {
        $category = Category::where('kategori', $categoryName)->first();
        if ($category) {
            $category->jumlah = $category->products()->count();
            $category->save();
        }
    }

    // Function to update the total product count
    private function updateTotalProductCount($categoryName) {
        $category = Category::where('kategori', $categoryName)->first();
        if ($category) {
            $totalProducts = Product::where('kategori_produk', $categoryName)->sum('jumlah_produk');
            $category->total_products = $totalProducts;
            $category->save();
        }
    }

    // Function to export the product data to PDF
    public function exportPdf() {
        try {
            $product = Product::all();
            $pdf = PDF::loadView('products.exportPdf', compact('product'));
            return $pdf->download('product.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to export data to PDF. Please try again.');
        }
    }

    // Function to export the product data to Excel
    public function exportXls()
    {
        try {
            return Excel::download(new ProductExport, 'product.xlsx');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to export data to Excel. Please try again.');
        }
    }

    // Function to import the product data from Excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new ProductImport, $request->file('file'));
            return redirect()->route('products.index')->with('success', 'Product data imported successfully from Excel file.');
        } catch (\Exception $e) {
            // Mengembalikan pesan error kepada pengguna
            return redirect()->back()->with('error', 'Failed to import data from Excel file. Please make sure the file format is correct and try again.');
        }
    }

    // Function to display the request purchase form
    public function requestPurchase() {
        $purchase = totalPurchase::all();
        return view('products.requestPurchase', compact('purchase'));
    }
    
    // Function to display the request sell form
    public function requestSell() {
        // $selling = Selling::where('status', 'pending')->get();
        $selling = Selling::all();
        return view('products.requestSell', compact('selling'));
    }

    // Function to store the purchase data
    private function reduceCategoryProductCount($categoryName, $quantity)
        {
            $category = Category::where('kategori', $categoryName)->first();
            if ($category) {
                $category->total_products -= $quantity;
                $category->save();
            }
        }

    // Function to store the purchase data
    private function increaseCategoryProductCount($categoryName, $quantity)
        {
            $category = Category::where('kategori', $categoryName)->first();
            if ($category) {
                $category->total_products += $quantity;
                $category->save();
            }
        }

    // Function to store the purchase data
    public function approveSell(Request $request, $id)
    {
        $selling = Selling::findOrFail($id);
        $selling->status = 'approved';
        $selling->save();

        $product = Product::where('nama_produk', $selling->product_name)->firstOrFail();
        $product->jumlah_produk -= $selling->quantity;
        $product->total_sales += $selling->quantity;
        $this->reduceCategoryProductCount($product->kategori_produk, $selling->quantity);
        $product->save();

        // Check if the customer exists, if not, add them
        $customer = Customer::where('nama_customer', $selling->customer_name)->first();
        if (!$customer) {
            $customer = new Customer;
            $customer->nama_customer = $selling->customer_name;
            $customer->save();
        }

        return redirect()->route('products.index')->with('success', 'Sale approved and product quantity updated.');
    }

    // Function to store the purchase data
    public function approvePurchase(Request $request, $id)
    {
        $purchase = totalPurchase::findOrFail($id);
        $purchase->status = 'approved';
        $purchase->save();

        $product = Product::where('nama_produk', $purchase->product_name)->firstOrFail();
        $product->jumlah_produk += $purchase->quantity;
        $this->increaseCategoryProductCount($product->kategori_produk, $purchase->quantity);
        $product->save();

        return redirect()->route('products.index')->with('success', 'Purchase approved and product quantity updated.');
    }

    // Function to decline the sell request
    public function declineSell(Request $request, $id)
    {
        $selling = Selling::findOrFail($id);
        $selling->status = 'declined';
        $selling->save();

        return redirect()->route('products.index')->with('success', 'Sell Request declined successfully.');
    }

    // Function to decline the purchase request
    public function declinePurchase(Request $request, $id)
    {
        $purchase = totalPurchase::findOrFail($id);
        $purchase->status = 'declined';
        $purchase->save();

        return redirect()->route('products.index')->with('success', 'Purchase Request declined successfully.');
    }

}