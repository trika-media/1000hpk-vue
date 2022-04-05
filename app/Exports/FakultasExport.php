<?php

namespace App\Exports;

use App\Models\Fakultas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FakultasExport implements FromView
{
    public function view(): View
    {
        $fakultas = Fakultas::all(['kode', 'nama']);
        return view('exports.fakultas', compact('fakultas'));
    }
}
