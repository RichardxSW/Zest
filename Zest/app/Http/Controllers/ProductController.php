<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index() {
        $product = Product::all();

        return view('products.index', compact('product'));
    }

    public function create() {
        return view('products.create');
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

        Product::create($request->all());

        return redirect()->route('products.index');
            // ->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function delete($id) {
        $pro = Product::find($id);
        $pro->delete();
        return redirect()->route('products.index');
    }
}