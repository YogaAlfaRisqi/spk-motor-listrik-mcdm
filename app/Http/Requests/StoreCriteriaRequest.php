<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCriteriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Set sesuai dengan authorization logic Anda
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'kode_kriteria' => [
                'required',
                'string',
                'max:20',
                'unique:criterias,kode_kriteria'
            ],
            'nama_kriteria' => [
                'required',
                'string',
                'max:255',
            ],
            'keterangan' => [
                'nullable',
                'string',
                'max:1000'
            ],
            'skala_penilaian' => [
                'nullable',
                'string',
                'max:100'
            ],
            'tipe' => [
                'required',
                'string',
                'in:benefit,cost'
            ]
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'kode_kriteria.required' => 'Kode kriteria harus diisi',
            'kode_kriteria.unique' => 'Kode kriteria sudah terdaftar',
            'nama_kriteria.required' => 'Nama kriteria harus diisi',
            'tipe.required' => 'Tipe kriteria harus dipilih',
            'tipe.in' => 'Tipe kriteria tidak valid',
        ];
    }

    /**
     * Get the attributes that should be returned by default.
     */
    protected function getRedirectUrl()
    {
        return $this->redirectTo ?? url('/');
    }
}