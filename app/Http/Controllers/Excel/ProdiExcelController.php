<?php

namespace App\Http\Controllers\Excel;

use App\Exports\ProdiExport;
use App\Http\Controllers\Controller;
use App\Imports\ProdiImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProdiExcelController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'berkas' => ['required', 'file', 'mimes:xls,xlsx', 'max:5120'],
        ]);

        try {
            Excel::import(new ProdiImport, $request->file('berkas')->store('temp'));
            session()->flash('success', 'Import data prodi berhasil!');
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        return redirect()->route('master.prodi.index');
    }

    public function export()
    {
        $nama = '[' . date('Ymd') . ']-master-prodi.xlsx';
        return Excel::download(new ProdiExport, $nama);
    }
}
