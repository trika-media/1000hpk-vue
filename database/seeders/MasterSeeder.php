<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\Penyakit;
use App\Models\Prodi;
use App\Models\Puskesmas;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fakultas = [
            [
                'kode' => 'FK',
                'nama' => 'Fakultas Kedokteran',
            ]
        ];

        $prodi = [
            ['nama' => 'Ilmu Penyakit Mata',],
            ['nama' => 'Ilmu Penyakit Kulit dan Kelamin',],
            ['nama' => 'Ilmu Penyakit Telinga, Hidung dan Tenggorokan',],
            ['nama' => 'Ilmu Bedah',],
            ['nama' => 'Ilmu Kebidanan dan Penyakit Kandungan',],
        ];

        $penyakit = [
            [
                'kode' => 'PYK1',
                'nama' => 'Penyakit 1',
                'kelompok' => 'defisiensi',
            ],
            [
                'kode' => 'PYK2',
                'nama' => 'Penyakit 2',
                'kelompok' => 'menular',
            ],
            [
                'kode' => 'PYK3',
                'nama' => 'Penyakit 3',
                'kelompok' => 'fisiologis',
            ],
        ];

        # INPUT FAKULTAS
        foreach ($fakultas as $data) {
            Fakultas::create($data);
        }

        # INPUT PRODI
        $masterFakultas = Fakultas::first();
        foreach ($prodi as $data) {
            Prodi::create([
                'fakultas_id' => $masterFakultas->id,
                'nama' => $data['nama'],
            ]);
        }

        # INPUT PENYAKIT
        foreach ($penyakit as $data) {
            Penyakit::create($data);
        }

        # INPUT PUSKESMAS
        Puskesmas::create([
            'nama' => 'Puskesmas Sudiang Raya',
            'alamat' => 'Bumi Sudiang Permai, Jl. Perumnas Raya No.05, Sudiang Raya, Biringkaya, Kota Makassar, Sulawesi Selatan 90234',

            'kelurahan_id' => '73',
            'kecamatan_id' => '7371',
            'kabupaten_id' => '7371110',
            'provinsi_id' => '7371110010',

            'lat' => '-5.138746900888731',
            'lng' => '119.53492333230943',
        ]);

        # INPUT MAHASISWA
        $masterUser = User::where('role', 'user')->first();
        $masterProdi = Prodi::first();

        Mahasiswa::create([
            'user_id' => $masterUser->id,
            'fakultas_id' => $masterFakultas->id,
            'prodi_id' => $masterProdi->id,

            'nim' => '172039',
            'nama' => 'Abel Ardhana',
            'angkatan' => '2020',
            'nomor_ponsel' => '08781697xxx',
            'alamat' => 'Jl. Kima 10',
            'jenis_kelamin' => 'laki-laki',
        ]);
    }
}
