@extends('layout.template')
@section('isi')
<div class="card">
    <div class="card-body">
        <h1>Data Ruang Rawat <button  class="btn btn-success" style="float: right" data-bs-target="#tambah" data-bs-toggle="modal">Tambah Ruangan</button> </h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Ruangan</th>
                    <th>Kapasitas Tersisa</th>
                    <th>Harga Perhari</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($isi as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->nomor_ruang }}</td>
                    <td>{{ $item->kapasitas }}</td>
                    <td>{{ $item->harga }}</td>
                </tr>
                @endforeach
            </tbody>
            {{-- <pre>{{ print_r($isi) }}</pre> --}}
        </table>

        <div class="modal fade" id="tambah" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Tambah Ruangan</h4>
                    </div>
                    <form action="simpanruang" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label for="">Nomor Ruangan</label>
                                <input type="number" name="nomor_ruang" id="nomor_ruang" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Kapasitas Ruangan</label>
                                <input type="number" name="kapasitas" id="kapasitas" class="form-control" required>
                            </div>
                            <input type="hidden" name="kapasitas_awal">
                            <div class="form-group">
                                <label for="">Harga Perhari</label>
                                <input type="number" name="harga" id="harga" class="form-control" required>
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
