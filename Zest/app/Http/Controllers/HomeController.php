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
    //
    public function index() {
        $users = User::orderBy('created_at', 'asc')->get(); 
        $userCount = $users->count();
        // $userCount = DB::table('users')->count();
        $categoryCount = Category::count();
        $productCount = Product::count();
        $supplierCount = Supplier::count();
        // $customerCount = Customer::count();
        // $purchaseCount = Purchase::count();
        // $outgoingCount = OutgoingProduct::count();

        return view('homepage', compact(
            'users',
            'userCount',  
            'categoryCount', 
            'productCount', 
            'supplierCount', 
            // 'customerCount', 
            // 'purchaseCount', 
            // 'outgoingCount'
        ));
    }
}
