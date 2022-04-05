<?php

namespace App\Imports;

use App\Models\Fakultas;
use App\Models\Prodi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProdiImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $fakultas = Fakultas::where('kode', $row['kode_fakultas'])->first();

        if ($fakultas) {
            $prodi = Prodi::updateOrCreate(
                [
                    'fakultas_id' => $fakultas->id,
                    'nama' => $row['nama_prodi']
                ],
                []
            );

            return $prodi;
        }
    }
}
