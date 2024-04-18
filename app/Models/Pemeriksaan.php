<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;
    protected $table = 'pemeriksaans';
    protected $fillable = ['id_pasien', 'id_dokter', 'tanggal_periksa', 'diagnosis', 'tindakan', 'resep'];
}
