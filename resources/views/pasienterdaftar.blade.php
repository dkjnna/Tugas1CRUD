@extends('layout.template')
@section('isi')

<div class="card mt-3">
    <div class="card-body">
        <h1>Data Pasien yang Dirawat

        </h1>
        <div class="row g-10 align-items-center " style="float: right;">
            <div class="col-auto">
                <form action="pasienterdaftar" method="get">
                    <input type="search" name="search" id="" class="form-control" aria-describedby="passwordHelpInline">
                </form>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Nama Dokter</th>
                    <th>Nomor Ruang</th>
                    <th>Tanggal Daftar</th>
                    <th>Keluhan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no=1;
            @endphp
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
                @foreach ($isi as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->nama_pasien }}</td>
                    <td>{{ $item->nama_dokter }}</td>
                    <td>{{ $item->nomor_ruang }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->keluhan }}</td>
                    {{-- <td>{{ $item->status }}</td> --}}
                    <td>
                        {{-- <form action="{{ route('dipulangkan', ['id_pasien'=>$item->id_pasien ,'id_dokter'=>$item->id_dokter, 'id_ruangan'=>$item->id_ruangan]) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">dipulangkan</button>
                        </form> --}}
                        <a href="{{ route('dipulangkan', ['id'=>$item->id, 'id_pasien'=>$item->id_pasien ]) }}" class="btn btn-danger">Dipulangkan</a>
                        <a href="{{ route('rekap', ['id_pasien'=>$item->id_pasien]) }}" class="btn btn-warning mt-1" >Lihat Rekap Medis</a>
                        <a href="{{ route('tambahrekap', ['id' => $item->id]) }}" class="btn btn-primary mt-1" >Tambah Rekap Medis</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
