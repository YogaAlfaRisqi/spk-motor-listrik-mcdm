<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotorListrik extends Model
{
    //
    protected $table = 'motor_listrik'; // sesuaikan nama tabel kamu
    protected $primaryKey = 'id_motor';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'nama_motor',
        'harga',
        'jarak_tempuh',
        'waktu_pengisian',
        'kapasitas_baterai',
        'daya_maksimum',
    ];
}
