<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    protected $table = 'dokters';

    public function biayaDokter()
    {
        return $this->getAttribute('check_up');
    }
    protected $fillable = ['nama', 'spesialisasi', 'check_up', 'nomor_telepon'];
}
