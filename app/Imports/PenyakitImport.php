<?php

namespace App\Imports;

use App\Models\Penyakit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenyakitImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $penyakit = Penyakit::updateOrCreate(
            ['kode' => $row['kode']],
            [
                'nama' => $row['nama'],
                'kelompok' => $row['kelompok']
            ]
        );

        return $penyakit;
    }
}
