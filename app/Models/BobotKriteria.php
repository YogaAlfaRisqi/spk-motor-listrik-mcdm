<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BobotKriteria extends Model
{
    protected $table = 'bobot_kriteria'; // sesuaikan nama tabel kamu

    protected $primaryKey = 'id_bobot';

    public $incrementing = true;

    protected $keyType = 'int';
    //
    protected $fillable = [
        'id_kriteria',
        'bobot'
    ];

    public function kriteria()
    {
        return $this->belongsTo(Criteria::class, 'id_kriteria', 'nama_kriteria');
    }
}
