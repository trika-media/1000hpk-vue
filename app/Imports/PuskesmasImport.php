<?php

namespace App\Imports;

use App\Models\District;
use App\Models\Province;
use App\Models\Puskesmas;
use App\Models\Regency;
use App\Models\Village;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PuskesmasImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $provinsi = Province::where('name', $row['provinsi'])->first(['id']);
        $kabupaten = Regency::where('name', $row['kabupaten'])->first(['id']);
        $kecamatan = District::where('name', $row['kecamatan'])->first(['id']);
        $kelurahan = Village::where('name', $row['kelurahan'])->first(['id']);

        $puskesmas = Puskesmas::updateOrCreate(
            ['nama' => $row['nama']],
            [
                'alamat' => $row['alamat'],

                'kelurahan_id' => $kelurahan?->id,
                'kecamatan_id' => $kecamatan?->id,
                'kabupaten_id' => $kabupaten?->id,
                'provinsi_id' => $provinsi?->id,

                'lat' => $row['lat'],
                'lng' => $row['lng'],
            ]
        );

        return $puskesmas;
    }
}
