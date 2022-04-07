<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use App\Models\IbuHamil;
use Illuminate\Http\Request;
use Spipu\Html2Pdf\Html2Pdf;

class IbuHamilPdfController extends Controller
{
    public function profil()
    {
        $ibuhamil = IbuHamil::query()
            ->with(['kabupaten', 'provinsi'])
            ->latest()->paginate(10);

        $html2pdf = new Html2Pdf('L', 'A4', 'en', false, 'ISO-8859-15', array(10, 10, 10, 10));
        $view = view('pdf.ibu-hamil.profil', compact('ibuhamil'));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($view);
        $html2pdf->output("ibu-hamil-profil.pdf");
    }

    public function detail($id)
    {
        $ibuhamil = IbuHamil::query()
            ->with([
                'puskesmas',
                'kelurahan',
                'kecamatan',
                'kabupaten',
                'provinsi',
                'mahasiswa.akun',
                'keluhan.penyakit',
            ])->findOrFail($id);

        $html2pdf = new Html2Pdf('P', 'A4', 'en', false, 'ISO-8859-15', array(10, 10, 10, 10));
        $view = view('pdf.ibu-hamil.detail', compact('ibuhamil'));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($view);
        $html2pdf->output("ibu-hamil-detail-($ibuhamil->nama).pdf");
    }
}
