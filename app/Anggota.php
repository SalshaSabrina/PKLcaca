<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = ['kode_anggota', 'nama', 'jk', 'jurusan', 'alamat'];
    public $timestamps = true;

    public function peminjaman(){
        return $this->belongsTo('App\Peminjaman', 'kode_anggota');
    }

    public function pengembalian(){
        return $this->belongsTo('App\Pengembalian', 'kode_anggota');
    }
}
