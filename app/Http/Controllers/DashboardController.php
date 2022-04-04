<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\IbuHamil;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getData($request);
        return inertia('Dashboard', compact('data'));
    }

    public function getData($request)
    {
        $defaultTanggal = [
            'awal' => now()->startOfMonth()->format('Y-m-d'),
            'akhir' => now()->endOfMonth()->format('Y-m-d'),
        ];

        $tanggal = [
            'awal' => $request->awal ?? $defaultTanggal['awal'],
            'akhir' => $request->akhir ?? $defaultTanggal['akhir'],
        ];

        if (in_array(auth()->user()->role, ['user', 'mahasiswa'])) {
            $data = $this->mahasiswaData($tanggal);
        } elseif (in_array(auth()->user()->role, ['admin', 'superadmin'])) {
            $data = $this->adminData($tanggal);
        } else {
            $data = [];
        }

        return $data;
    }

    public function adminData($tanggal)
    {
        $ibuhamil = IbuHamil::query()
            ->with([
                'puskesmas',
                'kelurahan',
                'kecamatan',
                'kabupaten',
                'provinsi',
                'mahasiswa',
                'keluhan',
            ])
            ->when($tanggal['awal'], fn ($query, $value) => $query->whereDate('created_at', '>=', $value))
            ->when($tanggal['akhir'], fn ($query, $value) => $query->whereDate('created_at', '<=', $value))
            ->get();

        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahBerita = Berita::count();
        $jumlahIbuHamil = $ibuhamil->count();

        $mapBounds = $ibuhamil->map(function ($data, $key) {
            return [$data->lat, $data->lng];
        });

        return [
            'tanggal' => $tanggal,
            'ibuhamil' => $ibuhamil,
            'jumlah' => [
                'mahasiswa' => $jumlahMahasiswa,
                'berita' => $jumlahBerita,
                'ibuhamil' => $jumlahIbuHamil,
            ],
            'berita' => null,
            'map' => [
                'bounds' => $mapBounds,
            ],
        ];
    }

    public function mahasiswaData($tanggal)
    {
        $mahasiswaId = auth()->user()->mahasiswa?->id;

        $ibuhamil = IbuHamil::query()
            ->with([
                'puskesmas',
                'kelurahan',
                'kecamatan',
                'kabupaten',
                'provinsi',
                'mahasiswa',
                'keluhan',
            ])
            ->where('mahasiswa_id', $mahasiswaId)
            ->when($tanggal['awal'], fn ($query, $value) => $query->whereDate('created_at', '>=', $value))
            ->when($tanggal['akhir'], fn ($query, $value) => $query->whereDate('created_at', '<=', $value))
            ->get();

        $jumlahIbuHamil = $ibuhamil->count();
        $beritaTerbaru = Berita::query()
            ->where('tampil', true)
            ->latest()->limit(3)->get();

        $mapBounds = $ibuhamil->map(function ($data, $key) {
            return [$data->lat, $data->lng];
        });

        return [
            'tanggal' => $tanggal,
            'ibuhamil' => $ibuhamil,
            'jumlah' => [
                'mahasiswa' => null,
                'berita' => null,
                'ibuhamil' => $jumlahIbuHamil,
            ],
            'berita' => $beritaTerbaru,
            'map' => [
                'bounds' => $mapBounds,
            ],
        ];
    }
}
