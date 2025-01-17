<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
    // Function to display the homepage
    public function index() {
        $users = User::orderBy('created_at', 'asc')->get(); 
        $userCount = $users->count();
        $categoryCount = Category::count();
        $productCount = Product::count();
        $supplierCount = Supplier::count();

        return view('homepage', compact(
            'users',
            'userCount',  
            'categoryCount', 
            'productCount', 
            'supplierCount', 
        ));
    }
}
