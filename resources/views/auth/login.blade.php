<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title','Base')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset(elixir('css/default.css')) }}">
    <link rel="stylesheet" href="{{ asset('plugins/AdminLTE/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.cs') }}">
    <link rel="stylesheet" href="{{ asset('plugins/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/AdminLTE/dist/css/AdminLTE.min.css') }}">
    @yield('styles-after')
    @yield('styles-before')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ route('home') }}">
            <a href="">
                <img src="{{ asset('img/logo.png') }}" alt="Logo">
            </a>
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Acesso ao Sistema</p>

        {!! Form::open(['route' => 'login', 'method' => 'post']) !!}
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} has-feedback">
                {!! Form::text('username',null,[
                    'class' => 'form-control',
                    'placeholder' => 'Usuário',
                    'autocomplete' => 'off'
                ]) !!}
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('username'))
                    <span class="help-block">
                         <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
                {!! Form::password('password',[
                    'class' => 'form-control',
                    'placeholder' => 'Senha'
                ]) !!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Acessar Sistema</button>
                </div>
                <!-- /.col -->
            </div>
        {!! Form::close() !!}
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- REQUIRED JS SCRIPTS -->
<script src="{{ asset('plugins/jQuery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/AdminLTE/bootstrap/js/bootstrap.js') }}"></script>
@yield('scripts-after')
@yield('scripts-before')
<script src="{{ asset('plugins/AdminLTE/dist/js/app.js') }}"></script>
<script src="{{ asset('js/default.js') }}"></script>
</body>
</html>

