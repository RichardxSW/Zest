<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    //
    public function index() {
        $product = Product::orderBy('created_at', 'asc')->get(); 
        $category = Category::all(); // Mengambil semua kategori
        return view('products.index', compact('product', 'category')); // Mengirim data kategori ke view
    }

    public function create() {
        $categories = Category::all(); // Mengambil semua kategori
        return view('products.create', compact('categories'));
    }

    public function store(Request $request) {
        
        // dd = die and dump 
        // dd($request->all());

        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'jumlah_produk' => 'numeric',
            'kategori_produk' => 'required',
        ]);

        // Menyimpan data produk ke database
        $product = new Product;
        $product->nama_produk = $request->nama_produk;
        $product->harga_produk = $request->harga_produk;
        $product->jumlah_produk = $request->jumlah_produk;
        $product->kategori_produk = $request->kategori_produk;
        $product->save();

        $this->updateCategoryCount($product->kategori_produk);
        $this->updateTotalProductCount($product->kategori_produk);

        return redirect()->route('products.index')
            ->with('success', 'Product added successfully');
    }

    public function edit($id) {
        $pro = Product::find($id);
        return view('products.edit', compact('product'));
    }

    public function update($id, Request $request) {

        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'numeric',
            'jumlah_produk' => 'numeric',
            'kategori_produk' => 'required',
        ]);

        $update = [
            'nama_produk' => $request->nama_produk,
            'harga_produk' => $request->harga_produk,
            'jumlah_produk' => $request->jumlah_produk,
            'kategori_produk' => $request->kategori_produk,
        ];

        $product = Product::find($id);
        $oldCategory = $product->kategori_produk;

        $product->update($request->all());
        $this->updateCategoryCount($oldCategory);
        $this->updateCategoryCount($request->kategori_produk);
        $this->updateTotalProductCount($oldCategory);
        $this->updateTotalProductCount($request->kategori_produk);

        return redirect()->route('products.index')
        ->with('success', 'Product updated successfully');
    }
    public function delete($id) {
        $product = Product::find($id);
        $category = $product->kategori_produk;
        $product->delete();
        $this->updateCategoryCount($category);
        $this->updateTotalProductCount($category);

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }

    public function search(Request $request)
    {
        $category = Category::all();

        $query = $request->input('query');

        $product = Product::query()
            ->where('nama_produk', 'ILIKE', '%' . $query . '%')
            ->orWhere('harga_produk', 'ILIKE', '%' . $query . '%')
            ->orWhere('jumlah_produk', 'ILIKE', '%' . $query . '%')
            ->orWhere('kategori_produk', 'ILIKE', '%' . $query . '%')
            ->get();

        return view("products.index", compact("product, category"));
    }

    private function updateCategoryCount($categoryName) {
        $category = Category::where('kategori', $categoryName)->first();
        if ($category) {
            $category->jumlah = $category->products()->count();
            $category->save();
        }
    }

    private function updateTotalProductCount($categoryName) {
        $category = Category::where('kategori', $categoryName)->first();
        if ($category) {
            $totalProducts = Product::where('kategori_produk', $categoryName)->sum('jumlah_produk');
            $category->total_products = $totalProducts;
            $category->save();
        }
    }
}