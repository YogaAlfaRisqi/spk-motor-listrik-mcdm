<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MotorListrik extends Model
{
    use HasFactory;

    protected $table = 'motor_listrik'; // 🔥 wajib
    protected $primaryKey = 'id_motor'; // 🔥 wajib

    protected $fillable = [
        'nama_motor',
        'harga',
        'jarak_tempuh',
        'waktu_pengisian',
        'kapasitas_baterai',
        'daya_maksimum',
        'created_by', // 🔥 wajib kalau mau insert
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
