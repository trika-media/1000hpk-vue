<?php

namespace App\Http\Controllers\Excel;

use App\Exports\FakultasExport;
use App\Http\Controllers\Controller;
use App\Imports\FakultasImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FakultasExcelController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'berkas' => ['required', 'file', 'mimes:xls,xlsx', 'max:5120'],
        ]);

        try {
            Excel::import(new FakultasImport, $request->file('berkas')->store('temp'));
            session()->flash('success', 'Import data fakultas berhasil!');
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        return redirect()->route('master.fakultas.index');
    }

    public function export()
    {
        $nama = '[' . date('Ymd') . ']-master-fakultas.xlsx';
        return Excel::download(new FakultasExport, $nama);
    }
}
