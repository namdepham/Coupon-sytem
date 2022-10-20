<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- CSS only -->
    <link rel="stylesheet" href="{{ asset('asset_fe/css/style.css') }}">
    <title>Login</title>
</head>
<body>
<div class="login-box">
    <div class="login-header">
        <img src="{{ asset('asset_home/images/logo1.png') }}" width="80px" alt="Estudiez"/><a href=""></a>
    </div>
    <div class="login-body text-center">
        <img src="{{ asset('storage/'. 'qr.png')}}">
    </div>
</div>

</body>
</html>
<style>
    .login-box {
        height: 100%;
        border: 1px solid grey;
        position: relative;
        box-shadow: 21px 12px 24px 10px rgba(0, 0, 0, .5);
        background: #dadada;
    }

    .login-header {
        text-align: center;
        font-family: "vardhana", cursive;
        font-size: 35px;
        background: linear-gradient(to bottom, #e8e5e5 0%, #c2bbbb 100%);
        color: #fff;
        position: relative;
        box-shadow: 1px 3px 14px rgba(0, 0, 0, .5);
    }

    .login-body {
        padding: 20px;
        line-height: 2;
    }
</style>
