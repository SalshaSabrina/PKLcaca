<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetugasRequest extends FormRequest
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
            'kode_petugas' => 'required|max:4',
            'nama' => 'required',
            'jk' => 'required',
            'jabatan' => 'required',
            'telp' => 'required|numeric',
            'alamat' => 'required'
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
            'kode_petugas.required' => 'Kode Petugas wajib diisi',
            'kode_petugas.max' => 'Kode Petugas Maksimal 4 Karakter',
            'nama.required' => 'Nama Wajib Diisi',
            'jk.required' => 'Jenis Kelamin Harus Dipilih',
            'jabatan.required' => 'Jabatan Wajib Diisi',
            'telp.required' => 'Telp Wajib Diisi',
            'telp.numeric' => 'Harap Masukan Angka Saja',
            'alamat.required' => 'Alamat Wajib Diisi'
        ];
    }
}