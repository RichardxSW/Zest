<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\supplier;

class SupplierController extends Controller
{
    //index
    public function index()
    {
        $supplier = Supplier::all();

        return view("supplier.index", compact("supplier"));
    }
}
