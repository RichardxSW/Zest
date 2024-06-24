<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        
        $users = User::orderBy('created_at', 'asc')->get(); 
        $userCount = $users->count();
        // $userCount = DB::table('users')->count();
        $categoryCount = Category::count();
        $productCount = Product::count();
        $supplierCount = Supplier::count();
        $customerCount = Customer::count();
        // $purchaseCount = Purchase::count();
        // $outgoingCount = OutgoingProduct::count();

        $recentlyAddedProducts = Product::orderBy('created_at', 'desc')->take(5)->get();

        return view('homepage', compact(
            'users',
            'userCount',  
            'categoryCount', 
            'productCount', 
            'supplierCount', 
            'customerCount', 
            // 'purchaseCount', 
            // 'outgoingCount',
            'recentlyAddedProducts'
        ));
    }
}
