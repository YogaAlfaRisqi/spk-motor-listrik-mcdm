<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    /** @use HasFactory<\Database\Factories\AlternativeFactory> */
    use HasFactory;

protected $fillable = [
        'nama_motor',
        'harga',
        'jarak_tempuh',
        'waktu_pengisian',
        'kapasitas_baterai',
        'daya_maksimum'
    ];
}
