<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Ruangan;
class BiayaController extends Controller
{
    public function getBiaya($idDokter, $idRuangan)
    {
        $bd=Dokter::find($idDokter);
        $biayaCheckUpPerHari= $bd->biayaDokter();

        $br=Ruangan::find($idRuangan);
        $hargaRuanganPerHari= $br->biayaRuangan();

        return response()->json([
            'biayaCheckUpPerHari' => $biayaCheckUpPerHari,
            'hargaRuanganPerHari' => $hargaRuanganPerHari,
        ]);
    }
}


// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Dokter;
// use App\Models\Ruangan;

// class BiayaController extends Controller
// {
//     public function getBiaya(Request $request)
//     {
//
//         $idDokter = $request->input('id_dokter');
//         $idRuangan = $request->input('id_ruangan');
//         $biayaDokter = Dokter::where('id_dokter', $idDokter)->first();
//         $biayaKamar = Ruangan::where('id_ruangan', $idRuangan)->first();

//
//         if ($biayaDokter && $biayaKamar) {
//             return response()->json([
//                 'biayaCheckUpPerHari' => $biayaDokter->check_up,
//                 'hargaRuanganPerHari' => $biayaKamar->harga,
//             ]);
//         } else {
//             return response()->json(['error' => 'Biaya tidak ditemukan'], 404);
//         }
//     }
// }


// $biayaCheckUpPerHari = Dokter::where('id_dokter', $idDokter);
        // $hargaRuanganPerHari = Ruangan::avg('harga');
