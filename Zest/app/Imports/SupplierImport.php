<?php

namespace App\Imports;

use App\Models\supplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SupplierImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new supplier([
            'id' => $row['id'],
            'name' => $row['name'],
            'address' => $row['address'],
            'email' => $row['email'],
            'contact'=> $row['contact'],
        ]);
    }
}