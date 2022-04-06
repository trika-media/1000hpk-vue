<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\IbuHamil;
use Illuminate\Http\Request;

class IbuHamilReportController extends Controller
{
    public function profil()
    {
        $ibuhamil = IbuHamil::query()
            ->with(['kabupaten', 'provinsi'])
            ->latest()->paginate(10);

        return inertia('Report/IbuHamil/Profil', compact('ibuhamil'));
    }
}
