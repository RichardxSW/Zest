<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Customer([
            'id' => $row['id'],
            'nama_produk' => $row['nama_produk'],
            'harga_produk' => $row['harga_produk'],
            'jumlah_produk' => $row['jumlah_produk'],
            'kategori_produk' => $row['kategori_produk'],
        ]);
    }
}