<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3>Formulir Pemulangan Pasien tanpa Rawat Inap</h3>
                <form action="{{ route('dipulangkanpas', [$id]) }}" method="post">
                    @csrf
                    <input type="hidden" name="id_pasien" value="{{ $id }}">
                    <div class="mb-3">
                        <label for="dokter" class="form-label">Pilih dokter</label>
                        <select name="id_dokter" id="id_dokter" class="form-control" required>
                            <option value=""></option>
                            @foreach($dokter as $isi)
                                <option value="{{ $isi->id }}">{{ $isi->nama }} - {{ $isi->spesialisasi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="id_ruangan" value="{{ $id_ruangan }}">
                    <input type="hidden" name="tanggal_daftar">
                    <input type="hidden" name="tanggal_pulang">
                    <div class="mb-3">
                        <label for="diagnosis">Diagnosis</label>
                        <input type="text" name="diagnosis" id="diagnosis" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="tindakan">Tindakan</label>
                        <input type="text" name="tindakan" id="tindakan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="resep">Resep</label>
                        <input type="text" name="resep" id="resep" class="form-control">
                    </div>
                    <input type="hidden" name="biaya" value="{{ $biaya }}">

                    <button type="submit" class="btn btn-warning">Pulangkan</button>
                    <a href="/datapasien" class="btn btn-primary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
