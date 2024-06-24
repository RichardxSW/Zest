<?php

namespace App\Exports;

use App\Models\Selling;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SellingExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of sellings.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Selling::all(['id', 'product_name', 'category_name', 'customer_name', 'quantity', 'date', 'status']);
    }

    /**
     * Return the headings for the Excel sheet.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Product Name',
            'Category Name',
            'Customer Name',
            'Quantity',
            'Date',
            'Status',
        ];
    }
}