<?php

use App\Http\Controllers\BiayaController;
use Illuminate\Support\Facades\Route;
use App\Models\Pasien;
use App\Models\Daftar;
use App\Models\Dokter;
use App\Models\Pemeriksaan;
use App\Models\Pulang;
use App\Models\Ruangan;
use App\Http\Controllers\Kendali;
use Illuminate\Http\Request;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['admin'])->group(function () {

    Route::get('datapasien', function(Request $request){
        $statusDitampilkan = ['dirawat', 'menunggu'];

        if ($request->has('search')) {
            $data = Pasien::where('nama', 'LIKE', '%'.$request->search.'%')
                          ->whereIn('status', $statusDitampilkan)
                          ->paginate(5);
        } else {
            $data = Pasien::whereIn('status', $statusDitampilkan)->paginate(5);
        }

        $nama = $request->session()->get('nama');
        return view('datapasien', ['isi' => $data, 'nama'=>$nama]);
    })->name('datapasien');
    Route::get('daftarkan/{id}', function($id){
        $ruangan = Ruangan::where('kapasitas', '>', 0)->get();

        $dokter = Dokter::all();
        return view('daftarkamar', ['ruangan' => $ruangan, 'dokternya' => $dokter, 'id_pasien' => $id]);
    })->name('daftarkan');

    Route::post('simpan', [Kendali::class, 'simpanpa']);

    Route::post('daftarkan', [Kendali::class, 'daftarkan']);

    Route::get('pasienterdaftar', [Kendali::class, 'datadaftar']);

    Route::get('tambahrekap/{id}', function($id){
        $pasien= Pasien::all();
        $dokter= Dokter::all();
        $daftar = Daftar::find($id);

        $idDokter = $daftar->idDokter();
    $idPasien = $daftar->idPasien();


        return view('tambahrekap', ['pasien'=>$pasien, 'dokternya'=>$dokter, 'id' => $id, 'id_pasien'=>$idPasien, 'id_dokter'=>$idDokter]);
    })->name('tambahrekap');

    Route::post('tambahrekap', [Kendali::class, 'tambahrekap']);

    // Route::get('rekap/{id_pasien}', function($id_pasien){
    //     $data= Pemeriksaan::select('pemeriksaans.id', 'pemeriksaans.tanggal_periksa', 'pasiens.nama as nama_pasien', 'dokters.nama as nama_dokter',  'pemeriksaans.diagnosis', 'pemeriksaans.resep', 'pemeriksaans.tindakan')
    //         ->join('pasiens', 'pasiens.id', '=', 'pemeriksaans.id_pasien')
    //         ->join('dokters', 'dokters.id', '=', 'pemeriksaans.id_dokter')
    //         ->where('pemeriksaans.id_pasien', $id_pasien)
    //         ->get();
    //     $pasien=Pasien::find($id_pasien);
    //     $namaPasien = $pasien->namaPasien();
    //     $rawat=Daftar::find($id_pasien);
    //     $tanggalrawat= $rawat->tanggalRawat();
    //     $adadata=Pemeriksaan::count();
    //     return view('rekapmedis', ['isi'=>$data, 'nama_pasien'=>$namaPasien, 'tanggal_rawat'=>$tanggalrawat, 'ada_data'=>$adadata]);
    // })->name('rekap');

    Route::get('rekap/{id_pasien}', function($id_pasien){
        $data= Pemeriksaan::select('pemeriksaans.id', 'pemeriksaans.tanggal_periksa', 'pasiens.nama as nama_pasien', 'dokters.nama as nama_dokter',  'pemeriksaans.diagnosis', 'pemeriksaans.resep', 'pemeriksaans.tindakan', 'pasiens.id as id_pasien', 'dokters.id as id_dokter', 'pemeriksaans.tanggal_periksa')
            ->join('pasiens', 'pasiens.id', '=', 'pemeriksaans.id_pasien')
            ->join('dokters', 'dokters.id', '=', 'pemeriksaans.id_dokter')
            ->where('pemeriksaans.id_pasien', $id_pasien)
            ->get();
        $pasien = Pasien::find($id_pasien);
        $namaPasien = $pasien->namaPasien();
        $rawat = Daftar::find($id_pasien);
        $tanggalrawat = $rawat ? $rawat->tanggalRawat() : null;
        $adadata = Pemeriksaan::count();

        return view('rekapmedis', ['isi'=>$data, 'nama_pasien'=>$namaPasien, 'tanggalrawat'=>$tanggalrawat, 'ada_data'=>$adadata]);
    })->name('rekap');




    Route::delete('hapus/{id}', function($id){
        $data = Pemeriksaan::find($id);
        if ($data) {
            $id_pasien = $data->id_pasien;
            $data->delete();
            return redirect()->route('rekap', ['id_pasien' => $id_pasien])->with('success', 'Data Berhasil Dihapus');
            // return redirect('pasienterdaftar');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    })->name('hapus');


    Route::get('editrekap/{id}/{id_pasien}/{id_dokter}/{tanggal_periksa}', [Kendali::class, 'editRekap'])->name('editrekap');

    Route::post('updaterekap', [Kendali::class, 'updaterekap'])->name('updaterekap');
    Route::post('pulangdaftar/{id}', [Kendali::class, 'dipulangkandaf'])->name('pulangdaftar');

    Route::get('dipulangkan/{id}', function($id){
        $data = Daftar::with('pasien')->first();
        $data2 = Daftar::findOrFail($id);
        $id_pasien= $data2->id_pasien;
        return view('pulangdaftar', ['isi'=>$data, 'id_pasien'=>$id_pasien , 'id'=>$id]);
    })->name('dipulangkan');


    Route::post('dipulangkanpas/{id}', [Kendali::class, 'dipulangkanpas'])->name('dipulangkanpas');

    Route::get('pulangpasien/{id}', function($id){
        $dokter = Dokter::all();
        $idruang = 0;
        $biaya =0;
        return view('dipulangkanpasien', ['id'=>$id, 'dokter'=>$dokter, 'id_ruangan'=>$idruang, 'biaya'=>$biaya]);

    })->name('pulangpasien');

    Route::get('dataPulang', [Kendali::class, 'dataPulang'])->name('dataPulang');

    // Route::get('pulang', function(){
    //     $data = Daftar::select('pasiens.nama as nama_pasien', 'daftars.tanggal as tanggal_daftar', 'pulangs.tanggal_pulang', 'pulangs.diagnosis', 'pulangs.tindakan', 'pulangs.resep')
    //         ->join('pulangs', 'daftars.id_pasien', '=', 'pulangs.id_pasien')
    //         ->join('pasiens', 'daftars.id_pasien', '=', 'pasiens.id') ->get();
    //     return view('pasienpulang', ['pulangnya' => $data]);
    // });

    Route::delete('hapuspulang/{id}', function($id){
        $data = Pulang::find($id);
        if ($data) {
            $data->delete();
            return redirect('dataPulang');
            // return redirect('pasienterdaftar');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    })->name('hapuspulang');

    Route::get('datakamar', function(){
        $data= Ruangan::all();
        return view('datakamar', ['isi'=>$data]);
    })->name('datakamar');

    Route::post('simpanruang', [Kendali::class, 'simpanruang']);

    Route::get('datadokter', function(){
        $data= Dokter::all();
        return view('datadokter', ['isi'=>$data]);
    })->name('datadokter');

    Route::post('simpandokter', [Kendali::class, 'simpandokter']);

    Route::delete('hapusdokter/{id}', function($id){
        $data = Dokter::find($id);
        if ($data) {
            $data->delete();
            return redirect('datadokter');
            // return redirect('pasienterdaftar');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
    })->name('hapusdokter');

    Route::get('editdokter/{id}', function($id){
        $data=Dokter::where('id', $id)->first();
        return view('editdokter', ['item'=>$data]);
    })->name('editdokter');

    Route::post('updatedokter', [Kendali::class, 'updatedokter'])->name('updatedokter');


    Route::get('get-biaya/{id_dokter}/{id_ruangan}', [BiayaController::class, 'getBiaya']);
});
//baris selanjutnya itu yang dikecualikan dari midelwer

Route::get('/', function(){
    return view('login');
});
Route::get('login', function(){
    return view('login');
});

Route::post('prosesLogin', [Kendali::class, 'prosesLogin'])->name('prosesLogin');

Route::get('logout', [Kendali::class, 'logout']);

Route::get('register', function(){
    return view('register');
});

Route::post('prosesRegister', [Kendali::class, 'prosesRegister'])->name('prosesRegister');



