<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    // Show all categories in categories.index view
    public function index() {
        $category = Category::orderBy('created_at', 'asc')->get(); 

        return view('categories.index', compact('category'));
    }

    // Show the form to create a new category
    public function create() {
        return view('categories.create');
    }

    // Store the new category
    public function store(Request $request) {
        $request->validate([
            'kategori' => 'required|string|max:255',
            'jumlah' => 'numeric',
        ]);

        try{
            $category = new Category;
            $category-> kategori = ucwords(strtolower($request->input('kategori')));
            $category-> jumlah = 0;
            $category-> total_products = 0;
            $category->save();

            return redirect()->route('categories.index')->with('success', 'Category added successfully');
        }catch(\Exception $e){
            return redirect()->route('categories.index')->with('error', 'Failed to add category. Please try again.');
        }
    }

    // Show the form to edit a category
    public function edit($id) {
        $cat = Category::find($id);
        return view('categories.edit', compact('cat'));
    }

    // Update the category
    public function update($id, Request $request) {
        $request->validate([
            'kategori' => 'required|string|max:255'
        ]);
    
        $category = Category::findOrFail($id);
        $category->kategori = ucwords(strtolower($request->input('kategori')));
        $category->save();
    
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    // Delete the category
    public function delete($id) {
        $cat = Category::find($id);
        $cat->delete();
        return redirect()->route('categories.index')
        ->with('success', 'Category deleted successfully');
    }
}
