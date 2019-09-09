<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $fillable = ['kode_kembali','tanggal_kembali','jatuh_tempo','denda_perhari','jumlah_hari','total_denda','kode_petugas','kode_anggota','kode_buku'];
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
