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
                <h3>Formulir Daftar Rawat Inap
                </h3>
                <form action="/daftarkan" method="post">
                    @csrf
                    <input type="hidden" name="id_pasien" value="{{ $id_pasien }}">
                <div class="mb-3">
                    <label for="ruangan" class="form-label">Pilih Ruangan</label>
                    <select name="id_ruangan" id="id_ruangan" class="form-control" required>
                        <option value=""></option>
                        @foreach($ruangan as $isi)
                            <option value="{{ $isi->id }}">{{ $isi->nomor_ruang }} -- kapasitas tersedia : {{ $isi->kapasitas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dokter" class="form-label">Pilih dokter</label>
                    <select name="id_dokter" id="id_dokter" class="form-control" required>
                        <option value=""></option>
                        @foreach($dokternya as $isi)
                            <option value="{{ $isi->id }}">{{ $isi->nama }} - {{ $isi->spesialisasi }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="tanggal">
                <div class="mb-3">
                    <label for="keluhan" class="form-label">Keluhan</label>
                    <input type="text" name="keluhan" id="keluhan" class="form-control" required>
                </div>
                <input type="hidden" name="status">
                {{-- <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value=""></option>
                        <option value="dalam pera">Dalam Perawatan</option>
                        <option value="dipulangkan">Dipulangkan</option>
                    </select>
                </div> --}}
                <button type="submit" class="btn btn-primary">Daftarkan</button>

                <a href="/datapasien" class="btn btn-info">Kembali</a>
                </form>

            </div>
        </div>
    </div>
</body>
</html>
