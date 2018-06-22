@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/form-elements.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="{{ asset('vendor/adminlte/ico/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('vendor/adminlte/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('vendor/adminlte/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('vendor/adminlte/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('vendor/adminlte/ico/apple-touch-icon-57-precomposed.png') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="top-content">

        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1><a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a></h1>
                        <div class="description">
                            <p>Login Eredivisie Voetbal League App</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>{{ trans('adminlte::adminlte.login_message') }}</h3>
                                <p>Enter your email and password to log on:</p>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-lock"></i>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post"  class="login-form">
                                {!! csrf_field() !!}

                                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label class="sr-only" for="email">Email</label>
                                    <input type="email" name="email" class="form-username form-control" value="{{ old('email') }}"
                                           id="form-username" placeholder="{{ trans('adminlte::adminlte.email') }}">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label class="sr-only" for="password">Password</label>
                                    <input type="password" name="password" class="form-password form-control"
                                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="checkbox icheck">
                                            <label>
                                                <input class="form-top-left" type="checkbox" name="remember">
                                                <span style="color: #fff;">{{ trans('adminlte::adminlte.remember_me') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                        <button type="submit"
                                                class="btn btn-primary btn-block btn-flat">{{ trans('adminlte::adminlte.sign_in') }}</button>
                                    <!-- /.col -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                        <p style="color: #fff; opacity: 0.8">{{ trans('adminlte::adminlte.login_message') }}</p>

                        <div class="auth-links">
                            <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}"
                               class="text-center"
                            >{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a>
                            <br>
                            @if (config('adminlte.register_url', 'register'))
                                <a href="{{ url(config('adminlte.register_url', 'register')) }}"
                                   class="text-center"
                                >{{ trans('adminlte::adminlte.register_a_new_membership') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/js/jquery.backstretch.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/js/scripts.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
