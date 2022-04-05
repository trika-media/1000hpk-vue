<?php

namespace App\Exports;

use App\Models\Prodi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProdiExport implements FromView
{
    public function view(): View
    {
        $prodi = Prodi::with('fakultas')->get(['fakultas_id', 'nama']);
        return view('exports.prodi', compact('prodi'));
    }
}
