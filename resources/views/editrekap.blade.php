<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <h1>Edit Rekap Medis</h1>
                <form action="{{ route('updaterekap') }}" method="post">
                    @csrf
                    <input type="hidden" name="id_pasien" value="{{ $id_pasien }}">
                    <input type="hidden" name="id_dokter" value="{{ $id_dokter }}">
                    <input type="hidden" name="tanggal_periksa" value="{{ $tanggal_periksa }}">
                    <div class="mt-3">
                        <label for="" class="form-label">Diagnosis</label>
                        <input type="text" name="diagnosis" id="diagnosis" class="form-control" value="{{ $isi->diagnosis }}" required>
                    </div>
                    <div class="mt-3">
                        <label for="" class="form-label">Tindakan</label>
                        <input type="text" name="tindakan" id="tindakan" class="form-control" value="{{ $isi->tindakan }}" required>
                    </div>
                    <div class="mt-3 mb-3">
                        <label for="" class="form-label">Resep</label>
                        <input type="text" name="resep" id="resep" class="form-control" value="{{ $isi->resep }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
                {{-- <pre>{{ print_r($isi) }}</pre> --}}
            </div>
        </div>
    </div>
</body>
</html>
