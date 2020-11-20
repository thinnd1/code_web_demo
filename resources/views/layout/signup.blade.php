<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <title>Document</title>
</head>
<body>
<div class="container">
    <h2>Đăng ký thành viên</h2>
    <form class="form-signup" action="{{ route('register') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="inputUsername">Tên Đăng Nhập*</label>
            <input type="text" name="username" class="form-control username" id="inputUsername"
                   placeholder="Nhập tên">
            <p class="error-msg"></p>
        </div>

        <div class="form-group">
            <label for="inputPassword">Mật Khẩu*</label>
            <input type="password" name="password" class="form-control password" id="inputPassword"
                   placeholder="Nhập mật khẩu">
            <p class="error-msg"></p>
        </div>

        <div class="form-group">
            <label for="inputFullName">Họ Và Tên*</label>
            <input type="text" name="full_name" class="form-control full-name" id="inputFullName"
                   placeholder="Nhập họ và tên">
            <p class="error-msg"></p>
        </div>

        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" name="email" class="form-control email" id="inputEmail"
                   placeholder="Nhập email">
            <p class="error-msg"></p>
        </div>

        <p>Đã có tài khoản, <a href="{{ route('viewlogin') }}">Đăng nhập</a></p>
        <button type="submit" class="btn btn-primary">Đăng ký</button>
    </form>
</div>

</body>
</html>
