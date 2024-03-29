<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnggotaRequest extends FormRequest
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
            'kode_anggota' => 'required|max:4',
            'nama' => 'required',
            'jk' => 'required',
            'jurusan' => 'required',
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
            'kode_anggota.required' => 'Kode Anggota wajib diisi',
            'kode_anggota.max' => 'Kode Anggota Maksimal 4 Karakter',
            'nama.required' => 'Nama Wajib Diisi',
            'jk.required' => 'Jenis Kelamin Harus Dipilih',
            'jurusan.required' => 'Jurusan Wajib Diisi',
            'alamat.required' => 'Alamat Wajib Diisi'

        ];
    }
}