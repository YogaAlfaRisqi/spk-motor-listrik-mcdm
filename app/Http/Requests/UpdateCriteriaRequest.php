<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCriteriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $criteriaId = $this->route('criterion'); // ← {criterion} bukan {criteria}

        return [
            'kode_kriteria' => [
                'required',
                'string',
                'max:20',
                Rule::unique('criterias', 'kode_kriteria')
                    ->ignore($criteriaId, 'id_kriteria'), // ← kolom PK custom
            ],
            'nama_kriteria'   => ['required', 'string', 'max:255'],
            'keterangan'      => ['nullable', 'string', 'max:1000'],
            'skala_penilaian' => ['nullable', 'string', 'max:100'],
            'tipe'            => ['required', 'string', 'in:benefit,cost'],
        ];
    }

    public function messages(): array
    {
        return [
            'kode_kriteria.required' => 'Kode kriteria harus diisi',
            'kode_kriteria.unique'   => 'Kode kriteria sudah terdaftar',
            'nama_kriteria.required' => 'Nama kriteria harus diisi',
            'tipe.required'          => 'Tipe kriteria harus dipilih',
            'tipe.in'                => 'Tipe kriteria tidak valid',
        ];
    }
}