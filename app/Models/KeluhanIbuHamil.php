<?php

namespace App\Models;

use App\Models\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class KeluhanIbuHamil extends Model
{
    use UUID;

    protected $table = 'keluhan_ibu_hamil';

    protected $fillable = [
        'ibu_hamil_id',
        'penyakit_id',
        'nama_penyakit',
    ];

    public function ibuhamil()
    {
        return $this->belongsTo('App\Models\IbuHamil', 'ibu_hamil_id', 'id')->withDefault();
    }

    public function penyakit()
    {
        return $this->belongsTo('App\Models\Penyakit', 'penyakit_id', 'id')->withDefault();
    }
}
