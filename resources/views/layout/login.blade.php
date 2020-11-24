<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <title>Đăng Nhập</title>
</head>
<body>
<div class="container">
    <h2>Đăng nhập</h2>
    <form class="form-signin" action="{{ route('login') }}" method="post">
        @csrf

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="form-group">
            <label for="inputUsername">Tên Đăng Nhập</label>
            <input type="text" name="username" class="form-control username" id="inputUsername" aria-describedby="emailHelp" placeholder="Nhập tên">
            @error('username')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="inputPassword">Mật Khẩu</label>
            <input type="password" name="password" class="form-control password" id="inputPassword" placeholder="Nhập mật khẩu">
            @error('password')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <a href="{{ route('viewregister') }}">Đăng ký tài khoản</a>
        <br>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
</div>

</body>
</html>
