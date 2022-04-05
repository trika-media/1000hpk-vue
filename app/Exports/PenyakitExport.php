<?php

namespace App\Exports;

use App\Models\Penyakit;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PenyakitExport implements FromView
{
    public function view(): View
    {
        $penyakit = Penyakit::all();
        return view('exports.penyakit', compact('penyakit'));
    }
}
