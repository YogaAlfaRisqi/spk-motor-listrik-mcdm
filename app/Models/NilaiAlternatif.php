<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiAlternatif extends Model
{
    //
    protected $table = 'nilai_alternatif'; // sesuaikan nama tabel kamu
    protected $primaryKey = 'id_nilai';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'id_alternatif',
        'id_kriteria',
        'nilai'
    ];
    public function motor_listrik()
    {
        return $this->belongsTo(MotorListrik::class, 'id_motor', 'nama_motor');
    }
    public function kriteria()
    {
        return $this->belongsTo(Criteria::class, 'id_kriteria', 'nama_kriteria');
    }
}
