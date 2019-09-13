<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengembalianRequest extends FormRequest
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
            'kode_kembali' => 'required|max:5',
            'tanggal_kembali' => 'required',
            'jatuh_tempo' => 'required',
            'kode_petugas' => 'required',
            'kode_anggota' => 'required',
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
            'kode_kembali.required' => 'Kode Kembali wajib diisi',
            'kode_kembali.max' => 'Kode Kembali Maksimal 4 Karakter',
            'tanggal_kembali.required' => 'Tanggal Kembali Wajib Diisi',
            'jatuh_tempo.required' => 'Jatuh Tempo Harus Dipilih',
            'kode_petugas.required' => 'Kode Petugas Wajib Diisi',
            'kode_anggota.required' => 'Kode Anggota wajib Diisi',
            'kode_buku.required' => 'Kode Buku Wajib Diisi'
        ];
    }
}
