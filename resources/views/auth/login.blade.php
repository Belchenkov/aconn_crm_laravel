<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Авторизация AconnCRM</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="http://homestead.app/pub/img/favicon.ico">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/nouslider/jquery.nouislider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">aconnCRM</h1>
        </div>

        <form method='post' action="{{ route('login') }}">

            {{ csrf_field() }}

            <div class="form-group">
                <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Пароль" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Войти</button>
        </form>
        <p class="m-t"><small>unixCRM &copy; 2015 - 2017</small> </p>
    </div>
</div>
</body>
</html>




