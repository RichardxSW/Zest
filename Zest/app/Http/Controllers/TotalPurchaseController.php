<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\totalpurchase;
use App\Models\Product;
use App\Models\Supplier;

class TotalPurchaseController extends Controller
{
    //index
    public function index(){
        $purchase = totalPurchase::all();
        $supplier = Supplier::all();
        $product = Product::all();
        $purchase = totalPurchase::orderBy('created_at', 'asc')->get();
        return view("totalpurchase.index", compact("purchase", "supplier", "product"));
    }

    public function create()
    {
        $supplier = Supplier::all();
        $product = Product::all();
        return view("totalpurchse.create", compact("supplier","product"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "product_name"=> "required",
            "supplier_name"=> "required",
            "quantity"=> "numeric",
            "in_date"=> "required",
        ]);

        $purchase = new totalpurchase();
        $purchase->product_name = $request->product_name;
        $purchase->supplier_name = $request->supplier_name;
        $purchase->quantity = $request->quantity;
        $purchase->in_date = $request->in_date;
        $purchase->save();

        // $this->updateCategoryCount($product->kategori_produk);
        // $this->updateTotalProductCount($product->kategori_produk);

        return redirect()->route('totalpurchase.index')
            ->with('success', 'Purchase added successfully');
    }

    public function edit($id)
    {
        $purchase = totalpurchase::find($id);
        $supplier = Supplier::all();
        $product = Product::all();
        return view('totalpurchase.edit', compact('purchase','supplier', 'product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "product_name"=> "required",
            "supplier_name"=> "required",
            "quantity"=> "numeric",
            "in_date"=> "required",
        ]);

        $update = [
            'product_name' => $request->product_name,
            'supplier_name' => $request->supplier_name,
            'quantity' => $request->quantity,
            'in_date' => $request->in_date,
        ];

        totalpurchase::whereId($id)->update($update);
        return redirect()->route('totalpurchase.index')
            ->with('success', 'Purchase updated successfully');
    }

    public function delete($id) {
        $purchase = totalpurchase::find($id);
        $purchase->delete();

        return redirect()->route('totalpurchase.index')
            ->with('success', 'Purchase deleted successfully');
    }
}
