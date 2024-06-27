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

        $highestTotalSale = Product::orderBy('total_sales', 'desc')->take(5)->get();
        $recentlyAddedProducts = Product::orderBy('created_at', 'desc')->take(5)->get();
        $lowQuantityProducts = Product::where('jumlah_produk', '<', 15)->get();

        // Get sales data for the current month and order by total_quantity
        $currentMonth = Carbon::now()->month;
        $selling = Selling::whereMonth('created_at', $currentMonth)
                ->where('status', 'approved') 
                ->selectRaw('product_name, SUM(quantity) as total_quantity')
                ->groupBy('product_name')
                ->orderBy('total_quantity', 'desc')
                ->take(5)
                ->get();

        $productNames = $selling->pluck('product_name');
        $productSales = $selling->pluck('total_quantity');

        // Logging the data for debugging purposes
        Log::info('Product Names:', $productNames->toArray());
        Log::info('Product Sales:', $productSales->toArray());
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
            'productSales'
            'highestTotalSale',
            'latestSale'
        ));
    }
}