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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kode_kriteria' => 'required|string|max:10',
            'nama_kriteria' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'skala_penilaian' => 'required|string|max:255',
            'tipe' => 'required|in:benefit,cost'
        ];
    }
}
