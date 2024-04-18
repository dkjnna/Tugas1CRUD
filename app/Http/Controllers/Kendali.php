<?php

namespace App\Http\Controllers;

use App\Models\Daftar;
use App\Models\Pemeriksaan;
use App\Models\Pasien;
use App\Models\Pulang;
use App\Models\Admin;
use App\Models\Dokter;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Kendali extends Controller
{
    public function simpanpa(Request $request){
        Pasien::create([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'nomor'=>$request->nomor,
            'status'=> 'menunggu'
        ]);
        return redirect('datapasien');
    }

    public function daftarkan(Request $request){
        Daftar::create([
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
            'id_ruangan' => $request->id_ruangan,
            'tanggal' => Carbon::now()->toDateTimeString(),
            'keluhan' => $request->keluhan,
            'status' => 'dirawat',
        ]);

        $pasien = Pasien::findOrFail($request->id_pasien);
        $pasien->status = 'dirawat';
        $pasien->save();

        $ruangan = Ruangan::findOrFail($request->id_ruangan);
        $ruangan->kapasitas -= 1;
        $ruangan->save();

        return redirect('pasienterdaftar')->with('success', 'Data Berhasil Ditambah');
    }



    public function datadaftar(Request $request){
        if ($request->has('search')) {
            $data = Daftar::select('daftars.id', 'daftars.tanggal', 'pasiens.nama as nama_pasien', 'dokters.nama as nama_dokter', 'ruangans.nomor_ruang', 'daftars.keluhan', 'daftars.status', 'pasiens.id as id_pasien')
            ->join('pasiens', 'pasiens.id', '=', 'daftars.id_pasien')
            ->join('dokters', 'dokters.id', '=', 'daftars.id_dokter')
            ->join('ruangans', 'ruangans.id', '=', 'daftars.id_ruangan')
            ->where('pasiens.nama', 'LIKE', '%'.$request->search.'%')
            ->orderBy('daftars.id')->paginate(5);
        } else {
            $data = Daftar::select('daftars.id', 'daftars.tanggal', 'pasiens.nama as nama_pasien', 'dokters.nama as nama_dokter', 'ruangans.nomor_ruang', 'daftars.keluhan', 'daftars.status', 'pasiens.id as id_pasien')
            ->join('pasiens', 'pasiens.id', '=', 'daftars.id_pasien')
            ->join('dokters', 'dokters.id', '=', 'daftars.id_dokter')
            ->join('ruangans', 'ruangans.id', '=', 'daftars.id_ruangan')
            ->orderBy('daftars.id')->paginate(5);
        }
        return view('pasienterdaftar', ['isi'=>$data]);
    }



    public function tambahrekap(Request $request){
        Pemeriksaan::create([
            'id_pasien'=>$request->id_pasien,
            'id_dokter'=>$request->id_dokter,
            'tanggal_periksa'=>Carbon::now()->toDateTimeString(),
            'diagnosis' => $request->diagnosis,
            'tindakan'=>$request->tindakan,
            'resep'=>$request->resep,
        ]);
        return redirect('pasienterdaftar');
    }

    // public function datarekap($id){
    //     $data= Pemeriksaan::select('pemeriksaans.id', 'pemeriksaans.tanggal', 'pasiens.nama as nama_pasien', 'dokters.nama as nama_dokter',  'pemeriksaans.diagnosis', 'pemeriksaans.resep', 'pemeriksaans.tindakan')
    // ->join('pasiens', 'pasiens.id', '=', 'pemeriksaans.id_pasien')
    // ->join('dokters', 'dokters.id', '=', 'pemeriksaans.id_dokter')
    // ->get();
    // // $itm= Daftar::all();
    // $nama_pasien=Pasien::find($id);
    // return view('rekapmedis', [compact('data'), 'nama_pasien'=>$nama_pasien]);
    // }

    public function editRekap($id, $id_pasien, $id_dokter, $tanggal_periksa){
        $data=Pemeriksaan::where('id', $id)->first();
        return view('editrekap', ['id' => $id, 'id_pasien' => $id_pasien, 'id_dokter' => $id_dokter, 'tanggal_periksa' => $tanggal_periksa, 'isi'=>$data]);
    }

    public function updaterekap(Request $request){
        Pemeriksaan::where([
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
            'tanggal_periksa' => $request->tanggal_periksa,
        ])->update([
            'diagnosis' => $request->diagnosis,
            'tindakan' => $request->tindakan,
            'resep' => $request->resep,
        ]);
        return redirect()->route('rekap', ['id_pasien' => $request->id_pasien])->with('success', 'Data Berhasil Diubah');
    }

    public function dipulangkandaf(Request $request, $id){
        $dtpas = Daftar::findOrFail($id);
        $id_pasien = $dtpas->id_pasien;

        $dtpemr = Pemeriksaan::where('id_pasien', $id_pasien)->first();

        if ($dtpemr) {
            Pulang::create([
                'id_pasien' => $id_pasien,
                'id_dokter' => $request->id_dokter,
                'id_ruangan' => $dtpas->id_ruangan,
                'tanggal_daftar' => $request->tanggal_daftar,
                'tanggal_pulang' => Carbon::now()->toDateTimeString(),
                'diagnosis' => $dtpemr->diagnosis,
                'tindakan' => $dtpemr->tindakan,
                'resep' => $dtpemr->resep,
                'biaya' => $request->biaya
            ]);
        } else {
            return redirect()->back()->with('error', 'Data Pemeriksaan Pasien Tidak Ditemukan, Silakan Periksa Kembali');
        }

        $dtpas->pasien->status = 'dipulangkan';
        $dtpas->pasien->save();
        $dtpas->delete();

        $ruanganpasienplg = Ruangan::find($dtpas->id_ruangan);

        if ($ruanganpasienplg->kapasitas < $ruanganpasienplg->kapasitas_awal) {
            $ruanganpasienplg->kapasitas += 1; //biar ruangannya nambah pas pasien diruangan itu pulang
            $ruanganpasienplg->save();
        } else {
            abort(400, 'Kapasitas ruangan sudah mencapai batas maksimum.');
        }

        return redirect('dataPulang');
    }

    public function dipulangkanpas(Request $request, $id){
        $pasien = Pasien::findOrFail($id);
        $data = Pasien::where('id', $id)->first();
        $tanggal_daftar_pasien = $pasien->created_at->toDateString();
        if ($data) {
            Pulang::create([
                'id_pasien'=>$data->id,
                'id_dokter'=>$request->id_dokter,
                'id_ruangan'=>$request->id_ruangan,
                'tanggal_daftar'=>$tanggal_daftar_pasien,
                'tanggal_pulang'=>Carbon::now()->toDateTimeString(),
                'diagnosis'=>$request->diagnosis,
                'tindakan'=>$request->tindakan,
                'resep'=>$request->resep,
                'biaya'=>$request->biaya
            ]);
        }
        $data3 = Pasien::findOrFail($id);
        $data3->status = 'dipulangkan';
        $data3->save();
        return redirect('dataPulang');
    }

    public function dataPulang(){
        $data = Pulang::with(['pasien', 'dokter', 'ruangan'])->get();
        return view('pasienpulang', ['isi' => $data]);
    }

    public function prosesLogin(Request $request){
        $username= $request->username;
        $password= $request->password;
        $data = Admin::where('username', $username)->where('password', $password)->first();
        if ($data) {
            $request->session()->put('nama', $data->nama);
            return redirect('datapasien');
        }else {
            return redirect()->back()->with('error', 'Data Admin Tidak Ditemukan, Silahkan Beri Inputan yang Valid atau Mendaftar');
        }
    }

    public function logout(Request $request){
        $request->session()->forget('nama');
        return redirect('login');
    }

    public function prosesRegister(Request $request){
        $admin = Admin::create([
            'username' => $request->username,
            'password' => $request->password,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan
        ]);

        if($admin){
            return redirect()->back()->with('success', 'Anda sudah memiliki akun, silahkan kembali ke halaman login untuk masuk ke akun anda');
        } else {
            return back()->with('error', 'Gagal menambahkan akun. Silahkan coba lagi.');
        }
    }

    public function simpanruang(Request $request){
        Ruangan::create([
            'nomor_ruang'=>$request->nomor_ruang,
            'kapasitas'=>$request->kapasitas,
            'kapasitas_awal'=>$request->kapasitas,
            'harga'=>$request->harga
        ]);

        return redirect('datakamar');
    }

    public function simpandokter(Request $request){
        Dokter::create([
            'nama'=>$request->nama,
            'spesialisasi'=>$request->spesialisasi,
            'check_up'=>$request->check_up,
            'nomor_telepon'=>$request->nomor_telepon
        ]);

        return redirect('datadokter');
    }

    public function updatedokter(Request $request){
        Dokter::where('id', $request->id)
          ->update([
              'nama' => $request->nama,
              'spesialisasi' => $request->spesialisasi,
              'check_up' => $request->check_up,
              'nomor_telepon' => $request->nomor_telepon,
          ]);
    return redirect()->route('datadokter')->with('success', 'Data Dokter Berhasil Diubah');
    }

}
