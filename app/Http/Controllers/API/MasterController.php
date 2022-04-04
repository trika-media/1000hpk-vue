<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function fakultas()
    {
        $fakultas = Fakultas::all();
        return response()->json($fakultas);
    }

    public function prodi($id)
    {
        $prodi = Prodi::where('fakultas_id', $id)->get();
        return response()->json($prodi);
    }
}
