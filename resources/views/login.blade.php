<!-- login.blade.php -->
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
    <div class="container mt-2">
        <div class="card">
            <div class="card-header">
                <h1>Form Login</h1>
            </div>
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
                <form action="{{ route('prosesLogin') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Username:</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-3">Login</button>
                </form>
            </div>
            <div class="card-footer">
                <p>Belum Memiliki Akun? Silahkan <a href="register" style="text-decoration: none">Masuk</a></p>
            </div>

        </div>
    </div>
</body>
</html>
