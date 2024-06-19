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

        return redirect()->route('categories.index')
            ->with('success', 'Category added successfully');
    }

    public function edit($id) {
        $cat = Category::find($id);
        return view('categories.edit', compact('cat'));
    }

    public function update($id, Request $request) {

        $request->validate([
            'kategori' => 'required',
            'jumlah' => 'numeric',

        ]);

        $update = [
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
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
}
