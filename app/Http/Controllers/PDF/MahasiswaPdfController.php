<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Spipu\Html2Pdf\Html2Pdf;

class MahasiswaPdfController extends Controller
{
    public function perAngkatan(Request $request)
    {
        $query = $request->angkatan;

        $angkatan = Mahasiswa::query()
            ->distinct('angkatan')
            ->whereNotNull('angkatan')
            ->pluck('angkatan');

        $mahasiswa = Mahasiswa::query()
            ->when($query, fn ($model, $value) => $model->where('angkatan', $value))
            ->with(['akun'])->latest()->paginate(10);

        $html2pdf = new Html2Pdf('P', 'A4', 'en', false, 'ISO-8859-15', array(10, 10, 10, 10));
        $view = view('pdf.mahasiswa.per-angkatan', compact('mahasiswa'));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($view);
        $html2pdf->output("mahasiswa-per-angkatan.pdf");
    }
}
