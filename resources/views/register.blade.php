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
    <div class="container mt-2">
        <div class="card">
            <div class="card-header">
                <h1>Form Pendaftaran</h1>
            </div>
            <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                <form action="{{ route('prosesRegister') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Username:</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Jabatan:</label>
                        <input type="text" name="jabatan" id="jabatan" class="form-control">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-3">Masuk</button>
                </form>
            </div>
            <div class="card-footer">
                <p>Sudah Memiliki Akun? Silahkan <a href="login" style="text-decoration: none">Login</a></p>
            </div>

        </div>
    </div>
</body>
</html>
