<?php

namespace App\Imports;

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Session;

class CustomersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Check for duplicate customer
        $duplicateCustomer = Customer::where('nama_customer', ucwords(strtolower($row['name'])))
            ->where('address_customer', ucwords(strtolower($row['address'])))
            ->where('email_customer', strtolower($row['email']))
            ->where('contact_customer', $row['contact'])
            ->first();

        if ($duplicateCustomer) {
            // Add error message to session
            $errorMessage = 'Duplicate entry for customer: ' . $row['name'] . ', ' . $row['email'];
            Session::push('import_errors', $errorMessage);

            // Skip duplicate record
            return null;
        }

        return new Customer([
            'id' => $row['id'],
            'nama_customer' => ucwords(strtolower($row['name'])),
            'address_customer' => ucwords(strtolower($row['address'])),
            'email_customer' => strtolower($row['email']),
            'contact_customer' => $row['contact'],
        ]);
    }
}