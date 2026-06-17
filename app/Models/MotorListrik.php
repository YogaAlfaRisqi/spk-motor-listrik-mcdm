<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorListrik extends Model
{
    use HasFactory;
    protected $table = 'motor_listrik'; 
    protected $primaryKey = 'id_motor'; 
    
    protected $fillable = [
        'nama_motor',
        'harga',
        'jarak_tempuh',
        'waktu_pengisian',
        'kapasitas_baterai',
        'daya_maksimum',
        'image',
        'created_by', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
