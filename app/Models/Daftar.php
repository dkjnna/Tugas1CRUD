<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar extends Model
{
    use HasFactory;
    protected $table = 'daftars';
    public function idPasien()
    {
        return $this->getAttribute('id_pasien');
    }

    // Mendefinisikan method untuk mengambil ID dokter
    public function idDokter()
    {
        return $this->getAttribute('id_dokter');
    }

    public function tanggalRawat(){
        return $this->getAttribute('tanggal');
    }
    
    public function ruangan()
{
    return $this->belongsTo(Ruangan::class, 'id_ruangan');
}

public function pasien()
{
    return $this->belongsTo(Pasien::class, 'id_pasien');
}
    protected $fillable = ['id_pasien', 'id_dokter', 'id_ruangan', 'tanggal', 'keluhan', 'status'];
}
