<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;

class IndonesiaController extends Controller
{
    public function provinsi()
    {
        $provinsi = Province::all();
        return response()->json($provinsi);
    }

    public function kabupaten($id)
    {
        $kabupaten = Regency::where('province_id', $id)->get();
        return response()->json($kabupaten);
    }

    public function kecamatan($id)
    {
        $kecamatan = District::where('regency_id', $id)->get();
        return response()->json($kecamatan);
    }

    public function kelurahan($id)
    {
        $kelurahan = Village::where('district_id', $id)->get();
        return response()->json($kelurahan);
    }
}
