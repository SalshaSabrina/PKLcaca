<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = ['kode_pinjem','tanggal_pinjam','tanggal_kembali','kode_petugas','kode_anggota','kode_buku'];
    public $timestamps = true;

    public function petugas(){
        return $this->hasMany('App\Petugas', 'kode_petugas');
    }

    public function anggota(){
        return $this->hasMany('App\Anggota', 'kode_anggota');
    }

    public function buku(){
        return $this->hasMany('App\Buku', 'kode_buku');
    }
}
