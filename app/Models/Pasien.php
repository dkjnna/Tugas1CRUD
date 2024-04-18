<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasiens';
    public function namaPasien()
    {
        return $this->getAttribute('nama');
    }
    public function idPas(){
        return $this->getAttribute('id');
    }
    protected $fillable = ['nama', 'alamat', 'tanggal_lahir', 'jenis_kelamin', 'nomor', 'status'];
}
