<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaReportController extends Controller
{
    public function perAngkatan(Request $request)
    {
        $query = $request->angkatan;

        $angkatan = Mahasiswa::query()
            ->distinct('angkatan')
            ->whereNotNull('angkatan')
            ->pluck('angkatan');

        $mahasiswa = Mahasiswa::query()
            ->when($query, fn ($model, $value) => $model->where('angkatan', $value))
            ->with(['akun'])->latest()->paginate(10);

        return inertia('Report/Mahasiswa/PerAngkatan', compact('mahasiswa', 'angkatan'));
    }
}
