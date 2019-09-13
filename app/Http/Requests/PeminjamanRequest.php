<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'kode_pinjem' => 'required|max:5',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
            'kode_petugas' => 'required',
            'kode_anggota' => 'required|numeric',
            'kode_buku' => 'required'
        ];
    }
     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'kode_pinjem.required' => 'Kode Peminjaman wajib diisi',
            'kode_pinjem.max' => 'Kode Peminjaman Maksimal 4 Karakter',
            'tanggal_pinjam.required' => 'Tanggal Pinjam Wajib Diisi',
            'tanggal_kembali.required' => 'Tanggal Kembali Harus Dipilih',
            'kode_petugas.required' => 'Kode Petugas Wajib Diisi',
            'kode_anggota.required' => 'Kode Anggota Wajib Diisi',
            'kode_buku.required' => 'Kode Buku Wajib Diisi'
        ];
    }
}