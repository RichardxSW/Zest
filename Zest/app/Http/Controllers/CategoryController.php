<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index() {
        $category = Category::all();

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

        Category::create($request->all());

        return redirect()->route('categories.index');
            // ->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function delete($id) {
        $cat = Category::find($id);
        $cat->delete();
        return redirect()->route('categories.index');
    }
}
