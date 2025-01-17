<?php

namespace App\Exports;

use App\Models\customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of customers.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Customer::all(['id', 'nama_customer', 'address_customer', 'email_customer', 'contact_customer']);
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
