@extends('layout.template')
@section('isi')
<div class="card">
    <div class="card-body">
        <h1>Data Dokter <button  class="btn btn-success" style="float: right" data-bs-target="#tambah" data-bs-toggle="modal">Tambah</button> </h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dokter</th>
                    <th>Spesialisasi</th>
                    <th>Biaya Check Up</th>
                    <th>Nomor Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($isi as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->spesialisasi }}</td>
                    <td>{{ $item->check_up }}</td>
                    <td>{{ $item->nomor_telepon }}</td>
                    <td>
                        <form action="{{ route('hapusdokter', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        <a href="{{ route('editdokter', ['id' => $item->id]) }}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            {{-- <pre>{{ print_r($isi) }}</pre> --}}
        </table>

        <div class="modal fade" id="tambah" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Tambah Dokter Baru</h4>
                    </div>
                    <form action="simpandokter" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Spesialisasi</label>
                                <input type="tect" name="spesialisasi" id="spesialisasi" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Biaya Check Up</label>
                                <input type="number" name="check_up" id="check_up" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nomor Telepon</label>
                                <input type="number" name="nomor_telepon" id="nomor_telepon" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success mt-3" type="submit">Tambahkan</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
