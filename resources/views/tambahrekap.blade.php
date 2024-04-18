<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Daftar Rawat Inap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <h3>Tambah Rekap Medis Pasien</h3>
                <form action="/tambahrekap" method="post">
                    @csrf
                    <input type="hidden" name="id_pasien" value="{{ $id_pasien }}">
                    <input type="hidden" name="id_dokter" value="{{ $id_dokter }}">
                <input type="hidden" name="tanggal">
                <div class="mb-3">
                    <label for="diagnosis" class="form-label">Diagnosis</label>
                    <input type="text" name="diagnosis" id="diagnosis" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="tindakan" class="form-label">Tindakan</label>
                    <input type="text" name="tindakan" id="tindakan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="resep" class="form-label">Resep</label>
                    <input type="text" name="resep" id="resep" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Tambahkan</button>
                <a href="/pasienterdaftar" class="btn btn-primary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
