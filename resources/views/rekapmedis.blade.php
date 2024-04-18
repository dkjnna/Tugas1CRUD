<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                <h1>Rekap Medis Pasien  : {{ $nama_pasien }} <a href="/pasienterdaftar" class="btn btn-primary" style="float: right">Kembali</a></h1>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pemeriksaan</th>
                            {{-- <th>Tanggal Rawat Inap</th> --}}
                            <th>Diagnosis</th>
                            <th>Tindakan</th>
                            <th>Resep</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                        @foreach ($isi as $item)
                        @php
                        $pemeriksaan = \App\Models\Pemeriksaan::find($item->id);

                        if ($pemeriksaan) {
                            $id_pasien = $pemeriksaan->id_pasien;
                            $id_dokter = $pemeriksaan->id_dokter;
                            $tanggal_periksa = $pemeriksaan->tanggal_periksa;
                        } else {
                            $id_pasien = null;
                            $id_dokter = null;
                            $tanggal_periksa = null;
                        }
                    @endphp

                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->tanggal_periksa }}</td>
                                {{-- <td>{{ $tanggalrawat }}</td> --}}
                                <td>{{ $item->diagnosis }}</td>
                                <td>{{ $item->tindakan }}</td>
                                <td>{{ $item->resep }}</td>
                                <td>
                                    <form action="{{ route('hapus', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>


                                    <a href="{{ route('editrekap', ['id' => $item->id, 'id_pasien' => $id_pasien, 'id_dokter' => $id_dokter, 'tanggal_periksa' => $tanggal_periksa]) }}" class="btn btn-warning">Edit</a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>

