<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use App\Models\KeluhanIbuHamil;
use Illuminate\Http\Request;
use Spipu\Html2Pdf\Html2Pdf;

class PenyakitPdfController extends Controller
{
    public function jumlahTerbanyak()
    {
        $keluhan = [];
        $data = KeluhanIbuHamil::query()
            ->with(['penyakit'])
            ->get()->groupBy('penyakit.nama');

        foreach ($data as $nama => $item) {
            $keluhan[] = (object) [
                'nama' => $nama,
                'jumlah' => count($item)
            ];
        }

        $keluhan = collect($keluhan)->sortByDesc('jumlah');

        $html2pdf = new Html2Pdf('P', 'A4', 'en', false, 'ISO-8859-15', array(10, 10, 10, 10));
        $view = view('pdf.penyakit.jumlah-terbanyak', compact('keluhan'));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($view);
        $html2pdf->output("jumlah-penyakit-terbanyak.pdf");
    }
}
