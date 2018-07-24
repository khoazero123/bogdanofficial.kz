@extends('layouts.app')

@section('content')




<header id="head" class="secondary"></header>

<!-- container -->
<div class="container">

    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li class="active">Регистрация</li>
    </ol>

    <div class="row">

        <!-- Article main content -->
        <article class="col-xs-12 maincontent">
            <header class="page-header">
                <h1 class="page-title">Регистрация</h1>
            </header>

            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="thin text-center">Зарегистрировать новую учетную запись</h3>
                        <p class="text-center text-muted">
                            Зарегистрированные пользователи получают доступ к нашим прогнозам и видеотрансляциям.
                        </p>
                        <hr>

                        <form method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}


                            <div class="top-margin{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label>Имя</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="top-margin{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label>E-mail</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="top-margin{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label>Номер телефона</label>
                                <input id="phone" type="text" class="form-control phone-mask" name="phone" value="{{ old('phone') }}" required>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif

                                <p>Укажите номер своего сотового телефона в международном формате. Например: 7916XXXXXX, 77081234555</p>
                            </div>





                            <div class="row top-margin">
                                <div class="col-sm-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label>Пароль <span class="text-danger">*</span></label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <label>Подтвердите пароль <span class="text-danger">*</span></label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-lg-6">

                                </div>
                                <div class="col-lg-6 text-right">
                                    <button class="btn btn-action" type="submit"><i class="fa fa-user"></i> Зарегистрироваться</button>
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
