<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'harga_produk',
        'jumlah_produk',
        'kategori_produk',
        'total_sales'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_produk', 'kategori');
    }

    public function selling()
    {
        return $this->hasMany(Selling::class, 'product_name', 'nama_produk');
    }

    protected $table = 'product';
}