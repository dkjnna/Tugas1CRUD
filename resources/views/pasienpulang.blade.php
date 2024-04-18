@extends('layout.template')
@section('isi')
<div class="card">
    <div class="card-body">
        <h1>Data Pasien Pulang</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nama Dokter</th>
                    <th>Nomor Ruang</th>
                    <th>Tanggal Daftar</th>
                    <th>Tanggal Pulang</th>
                    <th>Diagnosa</th>
                    <th>Tindakan</th>
                    <th>Resep</th>
                    <th>Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($isi as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ optional($item->pasien)->nama }}</td>
                    <td>{{ optional($item->dokter)->nama }}</td>
                    <td>{{ $item->ruangan ? $item->ruangan->nomor_ruang : 'Ruangan Tidak Tersedia' }}</td>
                    <td>{{ $item->tanggal_daftar }}</td>
                    <td>{{ $item->tanggal_pulang }}</td>
                    <td>{{ $item->diagnosis }}</td>
                    <td>{{ $item->tindakan }}</td>
                    <td>{{ $item->resep }}</td>
                    <td>
                        @if($item->biaya == 0)
                            Tidak dikenai biaya perawatan
                        @else
                            {{ $item->biaya }}
                        @endif
                    </td>

                    <td>
                        <form action="{{ route('hapuspulang', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
            {{-- <pre>{{ print_r($isi) }}</pre> --}}
        </table>
    </div>
</div>
@endsection
