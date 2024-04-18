<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pulang extends Model
{
    use HasFactory;
    protected $table = 'pulangs';
    protected $fillable = ['id_pasien', 'id_dokter', 'id_ruangan', 'tanggal_daftar', 'tanggal_pulang', 'diagnosis', 'tindakan', 'resep', 'biaya'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }
}
