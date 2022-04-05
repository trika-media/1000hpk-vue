<?php

namespace App\Http\Controllers\Excel;

use App\Exports\PuskesmasExport;
use App\Http\Controllers\Controller;
use App\Imports\PuskesmasImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PuskesmasExcelController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'berkas' => ['required', 'file', 'mimes:xls,xlsx', 'max:5120'],
        ]);

        try {
            Excel::import(new PuskesmasImport, $request->file('berkas')->store('temp'));
            session()->flash('success', 'Import data puskesmas berhasil!');
        } catch (\Exception $e) {
            session()->flash('danger', 'Gagal! ' . $e->getMessage());
            return redirect()->back();
        }

        return redirect()->route('master.puskesmas.index');
    }

    public function export()
    {
        $nama = '[' . date('Ymd') . ']-master-puskesmas.xlsx';
        return Excel::download(new PuskesmasExport, $nama);
    }
}
