<?php

namespace App\Exports;

use App\Models\supplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SupplierExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of customers.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return supplier::orderBy('created_at', 'asc')->get(['id', 'name', 'address', 'email', 'contact']);
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
            'Name',
            'Address',
            'Email',
            'Contact',
        ];
    }
}
