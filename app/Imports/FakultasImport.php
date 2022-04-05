<?php

namespace App\Imports;

use App\Models\Fakultas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FakultasImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $fakultas = Fakultas::updateOrCreate(
            ['kode' => $row['kode']],
            ['nama' => $row['nama']]
        );

        return $fakultas;
    }
}
