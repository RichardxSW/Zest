<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Selling;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\TotalPurchase;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

        $recentlyAddedProducts = Product::orderBy('created_at', 'desc')->take(5)->get();
        $lowQuantityProducts = Product::where('jumlah_produk', '<', 15)->get();

        // Get sales data for the current month and order by total_sales
        $currentMonth = Carbon::now()->month;
        $highestTotalSale = Product::orderBy('total_sales', 'desc')->take(5)->get();

        // Retrieve products and their names and sales
        $productNames = $highestTotalSale->pluck('nama_produk');
        $productSales = $highestTotalSale->pluck('total_sales');

        // Logging the data for debugging purposes
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
            'productNames',
            'productSales',
            'highestTotalSale',
            'latestSale',
        ));
    }
}