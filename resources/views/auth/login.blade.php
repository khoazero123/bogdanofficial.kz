@extends('layouts.app')

@section('content')

<header id="head" class="secondary"></header>
<!-- container -->
<div class="container">

    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
        <li class="active">Авторизация</li>
    </ol>

    <div class="row">

        <!-- Article main content -->
        <article class="col-xs-12 maincontent">
            <header class="page-header">
                <h1 class="page-title">Авторизация</h1>
            </header>

            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="thin text-center">Войдите в свой аккаунт</h3>
                        <hr>

                        <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="top-margin {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label>Email <span class="text-danger">*</span></label>
                                <input id="text" type="email" class="form-control phone-mask" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="top-margin {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label>Пароль <span class="text-danger">*</span></label>
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="top-margin">
                                <label>Запомни меня</label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            </div>


                            <hr>

                            <div class="row">
                                <div class="col-lg-8">
                                    <b><a href="/password/reset">Забыли пароль?</a></b>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <button class="btn btn-action" type="submit"><i class="fa fa-sign-out"></i> Войти</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </article>
        <!-- /Article -->

    </div>
</div>	<!-- /container -->


@endsection




