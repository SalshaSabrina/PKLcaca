<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $fillable = ['kode_petugas', 'nama', 'jk', 'jabatan', 'telp', 'alamat'];
    public $timestamps = true;

    public function peminjaman(){
        return $this->belongsTo('App\Peminjaman', 'kode_petugas');
    }

    public function pengembalian(){
        return $this->blongsTo('App\Pengembalian', 'kode_petugas');
    }
}
