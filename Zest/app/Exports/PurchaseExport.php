<?php

namespace App\Exports;

use App\Models\totalpurchase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PurchaseExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of customers.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TotalPurchase::orderBy('created_at', 'asc')->get(['id', 'product_name', 'supplier_name', 'quantity', 'in_date']);
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
            'Supplier Name',
            'Quantity',
            'In Date',
        ];
    }
}
