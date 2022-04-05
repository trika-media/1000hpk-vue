<?php

namespace App\Exports;

use App\Models\Puskesmas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PuskesmasExport implements FromView
{
    public function view(): View
    {
        $puskesmas = Puskesmas::query()
            ->with([
                'kelurahan',
                'kecamatan',
                'kabupaten',
                'provinsi',
            ])->get();

        return view('exports.puskesmas', compact('puskesmas'));
    }
}
