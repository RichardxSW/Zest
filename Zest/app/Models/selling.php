<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'category_name',
        'customer_name',
        'quantity',
        'date',
        // 'status',  // Remove 'status' from fillable to prevent direct mass assignment
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_name', 'nama_produk');
    }

    protected $table = 'selling';
}
