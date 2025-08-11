<?php

namespace App\Imports;

use App\Models\Opd;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class OpdImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Opd([
            'nama' => $row['nama'],
            'telepon' => $row['telepon'],
            'email' => $row['email'],
            'alamat' => $row['alamat'],
            'password' => bcrypt($row['password']), // Ensure password is hashed
        ]);
    }
}
