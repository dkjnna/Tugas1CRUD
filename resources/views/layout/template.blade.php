<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Rumah Sakit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <p align="right" style="font-size: 20px; font-weight:700; margin-top:3px">Selamat Datang, {{ Session::get('nama') }}
            <button class="btn btn-warning" style="float: right; margin-left: 10px; font-weight:500" data-bs-target="#konfir" data-bs-toggle="modal">Logout</button>
        </p>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('datapasien') }}" class="btn btn-info m-1">Data Pasien</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="pasienterdaftar" class="btn btn-primary m-2">Data Pasien Rawat Inap</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('dataPulang') }}" class="btn btn-warning">Data Pasien Pulang</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('datakamar') }}" class="btn btn-success m-2">Data Ruang Rawat</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('datadokter') }}" class="btn btn-secondary">Data Dokter</a></li>
            </ul>
        </nav>

        @yield('isi')

        <div class="modal fade" id="konfir" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Konfirmasi Logout</h4>
                    </div>
                    <div class="modal-body">
                        <h6>Apa anda akan logout?</h6>
                    </div>
                    <div class="modal-footer">
                        <a href="logout" class="btn btn-danger">Ya</a>
                        <a href="" class="btn btn-primary">Tidak</a>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
