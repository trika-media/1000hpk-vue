<?php

namespace App\Models;

use App\Models\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use UUID;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'gambar',
        'konten',
        'penulis',

        'tampil',
    ];

    protected $casts = [
        'tampil' => 'boolean',
    ];

    protected $appends = [
        'gambar_url'
    ];

    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            $gambar = asset($this->gambar);
        } else {
            $gambar = asset('assets/img/user.png');
        }

        return $gambar;
    }
}
