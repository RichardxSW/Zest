<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of customers.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::all(['id', 'nama_produk', 'harga_produk', 'jumlah_produk', 'kategori_produk']);
    }

    /**
     * Return the headings for the Excel sheet.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'id', 'nama_produk', 'harga_produk', 'jumlah_produk', 'kategori_produk'
        ];
    }
}
