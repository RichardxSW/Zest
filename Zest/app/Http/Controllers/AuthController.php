<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Selling;
use App\Models\TotalPurchase;

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
        $selling = Selling::where('status', 'approved')
                  ->orderBy('created_at', 'asc')
                  ->take(5)
                  ->get();
        
        $users = User::orderBy('created_at', 'asc')->get(); 
        $userCount = $users->count();
        $categoryCount = Category::count();
        $productCount = Product::count();
        $supplierCount = Supplier::count();
        $customerCount = Customer::count();
        $purchaseCount = totalPurchase::where('status', 'approved')->count();
        $saleCount = Selling::where('status', 'approved')->count();

        $highestTotalSale = Product::orderBy('total_sales', 'desc')->take(5)->get();
        $recentlyAddedProducts = Product::orderBy('created_at', 'desc')->take(5)->get();
        $lowQuantityProducts = Product::where('jumlah_produk', '<', 15)->get();
        $latestSale = Selling::where('status', 'approved')
                            ->orderBy('created_at', 'desc')->take(5)->get();

        return view('homepage', compact(
            'selling',
            'users',
            'userCount',  
            'categoryCount', 
            'productCount', 
            'supplierCount', 
            'customerCount', 
            'purchaseCount', 
            'saleCount',
            'recentlyAddedProducts',
            'lowQuantityProducts',
            'highestTotalSale',
            'latestSale'
        ));
    }
}
