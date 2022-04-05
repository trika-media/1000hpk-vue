<?php

namespace App\Http\Controllers\Excel;

use App\Exports\PenyakitExport;
use App\Http\Controllers\Controller;
use App\Imports\PenyakitImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PenyakitExcelController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'berkas' => ['required', 'file', 'mimes:xls,xlsx', 'max:5120'],
        ]);

        try {
            Excel::import(new PenyakitImport, $request->file('berkas')->store('temp'));
            session()->flash('success', 'Import data penyakit berhasil!');
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        return redirect()->route('master.penyakit.index');
    }

    public function export()
    {
        $nama = '[' . date('Ymd') . ']-master-penyakit.xlsx';
        return Excel::download(new PenyakitExport, $nama);
    }
}
