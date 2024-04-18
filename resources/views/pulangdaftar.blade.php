<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Formulir Pemulangan Pasien Dirawat</title>
</head>
<body>
    <div class="container">
        <div class="card mt-3">
            <div class="card-header">
                <h3>Formulir Pemulangan Pasien Dirawat</h3>
                <h5 style="float: right">Nama Pasien: {{ $isi->pasien->nama }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pulangdaftar', ['id' => $id]) }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id_pasien" value="{{ $id_pasien }}">
                    <input type="hidden" id="id_dokter" name="id_dokter" value="{{ $isi->id_dokter }}">
                    <input type="hidden" id="id_ruangan" name="id_ruangan" value="{{ $isi->id_ruangan }}">
                    <div class="mb-3">
                        <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
                        <input type="text" class="form-control" id="tanggal_daftar" name="tanggal_daftar" value="{{ $isi->tanggal }}" readonly>
                    </div>
                    <input type="hidden" name="tanggal_pulang">
                    <input type="hidden" name="diagnosis">
                    <input type="hidden" name="tindakan">
                    <input type="hidden" name="resep">
                    <div class="mb-3">
                        <label for="biaya" class="form-label">Total Biaya</label>
                        <input type="text" class="form-control" id="biaya" name="biaya" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Pulangkan dan Bayar</button>
                    <a href="/pasienterdaftar" class="btn btn-info">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        function getBiayaFromServer() {
            var idDokter = document.getElementById("id_dokter").value;
            var idRuangan = document.getElementById("id_ruangan").value;
            fetch('/get-biaya/'+idDokter+'/'+idRuangan)
                .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        var tanggalHariIni = new Date();
                        var tanggalDaftar = document.getElementById("tanggal_daftar").value;
                        var tanggalDaftarObj = new Date(tanggalDaftar);
                        var selisihHari = Math.ceil((tanggalHariIni - tanggalDaftarObj) / (1000 * 60 * 60 * 24));
                        var biayaCheckUpPerHari = data.biayaCheckUpPerHari;
                        var hargaRuanganPerHari = data.hargaRuanganPerHari;
                        var biayaCheckUpTotal = biayaCheckUpPerHari * selisihHari;
                        var biayaKamarTotal = hargaRuanganPerHari * selisihHari;
                        var biayaTotal = biayaCheckUpTotal + biayaKamarTotal;
                        var biayaTotalInt = parseInt(biayaTotal);
                        document.getElementById("biaya").value = biayaTotalInt;
                        console.log(tanggalDaftar);
                        console.log(selisihHari);
                        console.log(hargaRuanganPerHari);
                        console.log(biayaCheckUpPerHari);
                        console.log(biayaCheckUpTotal);
                        console.log(biayaTotal)
                        console.log(biayaKamarTotal)
                    })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        window.onload = getBiayaFromServer;
    </script>
</body>
</html>
