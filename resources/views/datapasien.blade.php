@extends('layout.template')
@section('isi')

<div class="card mt-3">
    <div class="card-body">
        <h1>Daftar Pasien<button class="btn btn-success" style="float: right" data-bs-target="#tambah" data-bs-toggle="modal">Daftarkan Pasien</button>
            <div class="row g-7 align-items-center mt-2 mb-2">
                <div class="col-auto">
                    <form action="datapasien" method="get">
                        <input type="search" name="search" id="" class="form-control" aria-describedby="passwordHelpInline">
                    </form>
                </div>
            </div>
        </h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Nomor Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no=1;
                @endphp
                @foreach ($isi as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->tanggal_lahir }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->nomor }}</td>
                    <td>
                        @php
                        $daftar_rawat_inap = \App\Models\Daftar::where('id_pasien', $item->id)->exists();
                        @endphp
                        @if($daftar_rawat_inap)
                        <button class="btn btn-primary" disabled>Daftarkan Rawat Inap</button>
                        @else
                        <a href="{{ route('daftarkan', ['id' => $item->id]) }}" class="btn btn-primary">Daftarkan Rawat Inap</a>
                        <a href="{{ route('pulangpasien', ['id' => $item->id]) }}" class="btn btn-warning">Pulangkan Pasien</a>
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        {{ $isi->links() }}
        <div class="modal fade" id="tambah" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Formulir Pendaftaran Pasien</h3>
                    </div>
                    <form action="simpan" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id">
                            <div class="mt-3">
                                <label for="nama">nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="alamat">alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="tanggal_lahir">tanggal_lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                            </div>
                            <div class="mt-3">
                                <label for="jenis_kelamin">jenis_kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                    <option value=""></option>
                                    <option value="L">Laki Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="mt-3">
                                <label for="nomor">nomor</label>
                                <input type="number" name="nomor" id="nomor" class="form-control">
                            </div>
                            <input type="hidden" name="status" id="status">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success mt-3" type="submit">DAFTARKAN PASIEN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
