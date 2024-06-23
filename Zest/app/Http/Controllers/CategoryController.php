<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index() {
        $category = Category::orderBy('created_at', 'asc')->get(); 

        return view('categories.index', compact('category'));
    }

    public function create() {
        return view('categories.create');
    }

    public function store(Request $request) {
        
        // dd = die and dump 
        // dd($request->all());

        $request->validate([
            'kategori' => 'required',
            'jumlah' => 'numeric',

        ]);

        // Menyimpan data produk ke database
        $category = new Category;
        $category-> kategori = $request->kategori;
        $category-> jumlah = 0;
        $category-> total_products = 0;
        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Category added successfully');
    }

    public function edit($id) {
        $cat = Category::find($id);
        return view('categories.edit', compact('cat'));
    }

    public function update($id, Request $request) {

        $request->validate([
            'kategori' => 'required'

        ]);

        $update = [
            'kategori' => $request->kategori
        ];

        Category::whereId($id)->update($update);

        return redirect()->route('categories.index')
        ->with('success', 'Category updated successfully');
    }

    public function delete($id) {
        $cat = Category::find($id);
        $cat->delete();
        return redirect()->route('categories.index')
        ->with('success', 'Category deleted successfully');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $category = Category::query()
            ->where('kategori', 'ILIKE', '%' . $query . '%')
            ->orWhere('jumlah', 'ILIKE', '%' . $query . '%')
            ->orWhere('total_products', 'ILIKE', '%' . $query . '%')
            // ->orWhere('email', 'ILIKE', '%' . $query . '%')
            // ->orWhere('contact', 'ILIKE', '%' . $query . '%')
            ->orderBy('created_at', 'asc') 
            ->get();

        return view("categories.index", compact("category"));
    }
}
