<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class totalpurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'product_name',
        'supplier_name',
        'quantity',
        'in_date',
    ];

    protected $table = 'totalpurchase';
}
