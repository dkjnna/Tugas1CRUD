@extends('layout.template')
@section('isi')
    <div class="card">
        <div class="card-body">
                <h3>Edit data dokter</h3>
                <form action="{{ route('updatedokter') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ $item->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Spesialisasi</label>
                            <input type="text" name="spesialisasi" id="spesialisasi" class="form-control" value="{{ $item->spesialisasi }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Biaya Check Up</label>
                            <input type="number" name="check_up" id="check_up" class="form-control" value="{{ $item->check_up }}" required>
                        </div>
                        <div class="form-group">
                            <label for="">Nomor Telepon</label>
                            <input type="number" name="nomor_telepon" id="nomor_telepon" class="form-control" value="{{ $item->nomor_telepon }}" required>
                        </div>
                        <button class="btn btn-success mt-3" type="submit">Simpan Perubahan</button>
                </form>
        </div>
    </div>
@endsection
