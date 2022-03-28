<?php

namespace App\Models;

use App\Models\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use UUID;

    protected $table = 'penyakit';

    protected $fillable = [
        'kode',
        'nama',
        'kelompok',
    ];
}
