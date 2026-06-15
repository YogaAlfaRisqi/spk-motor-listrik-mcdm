<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlternativeRequest extends FormRequest
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
    // Cek apakah input pertama adalah array (batch)
    $isBatch = is_array($this->all()) && isset($this->all()[0]);

    if ($isBatch) {
        return [
            '*.nama_motor'      => 'required|string',
            '*.harga'           => 'required|integer',
            '*.jarak_tempuh'    => 'required|integer',
            '*.waktu_pengisian' => 'required|integer',
            '*.kapasitas_baterai' => 'required|numeric',
            '*.daya_maksimum'   => 'required|numeric',
        ];
    }

    // Rules standar jika hanya kirim 1 data (bukan array)
    return [
        'nama_motor'      => 'required|string',
        'harga'           => 'required|integer',
        'jarak_tempuh'    => 'required|integer',
        'waktu_pengisian' => 'required|integer',
        'kapasitas_baterai' => 'required|numeric',
        'daya_maksimum'   => 'required|numeric',
        'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ];
}
}
