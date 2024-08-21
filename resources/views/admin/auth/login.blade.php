<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css-admin/css-login.css') }}">
</head>
<body>
    <div class="wrapper">
        <div class="container">
          <div class="col-left">
            <div class="login-text">
              <h2>Welcome Back Admin</h2>
              <p>A good new day</p>
            </div>
          </div>
          <div class="col-right">
            <div class="login-form">
              <h2>Login</h2>
              <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <p>
                  <label>Email<span>*</span></label>
                  <input type="email" name="email" placeholder="Email" required>
                </p>
                <p>
                  <label>Password<span>*</span></label>
                  <input type="password" name="password" placeholder="Password" required>
                </p>
                <p>
                  <input type="submit" value="Đăng nhập" />
                </p>
              </form>
            </div>
          </div>
        </div>
      </div>
</body>
</html>
