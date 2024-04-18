<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangans';
    protected $fillable = ['nomor_ruang', 'kapasitas', 'harga'];
    public function daftar()
    {
        return $this->hasMany(Daftar::class, 'id_ruangan');
    }

    public function biayaRuangan()
    {
        return $this->getAttribute('harga');
    }
}
