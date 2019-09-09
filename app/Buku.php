<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = ['kode_buku', 'judul', 'penulis', 'penerbit', 'tahun_terbit'];
    public $timestamps = true;

    public function rak(){
        return $this->belongsTo('App\Rak', 'kode_buku');
    }

    public function peminjaman(){
        return $this->bolongsTo('App\Peminjaman', 'kode_buku');
    }

    public function pengembalian(){
        return $this->belongsTo('App\Pengembalian', 'kode_buku');
    }
}
