<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_customer',
        'item_customer',
        'quantity_customer',
    ];

    protected $table = 'customer';
}