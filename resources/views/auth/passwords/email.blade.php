@extends('layouts.app')

@section('content')

<header id="head" class="secondary"></header>
<!-- container -->
<div class="container">

    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
        <li class="active">Забыли пароль</li>
    </ol>

    <div class="row">

        <!-- Article main content -->
        <article class="col-xs-12 maincontent">
            <header class="page-header">
                <h1 class="page-title">Забыли пароль</h1>
            </header>

            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="thin text-center">Забыли пароль</h3>
                        <hr>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}
                            <div class="top-margin {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label>Ваш e-mail <span class="text-danger">*</span></label>
                                <input id="text" type="email" class="form-control" name="email" value="{{ old('email') }}" required/>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12  text-right">
                                    <button class="btn btn-action" type="submit">Войти</button>
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