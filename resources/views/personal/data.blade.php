@extends('layouts.app')

@section('content')




<header id="head" class="secondary"></header>

<!-- container -->
<div class="container">

    <ol class="breadcrumb">
        <li><a href="/personal">Главная</a></li>
        <li class="active"><?=$title?></li>
    </ol>

    <div class="row">

        <div class="col-sm-12">

            @include('personal.layouts.tab')

            <div class="tab-content clearfix">


                <div  class="tab-pane fade in active">
                    <div class="panel panel-default">
                        <div class="panel-body">


                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                            @endif


                            <form method="POST" action="" class="form-horizontal">

                                {{csrf_field()}}




                                <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        <i class="fa fa-smile-o"></i>
                                        ФИО *:</label>
                                    <div class="col-sm-3">
                                        <input required="" value="<?=$current_user->name?>" name="name" class="form-control" type="text"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        <i class="fa fa-mail-forward"></i>
                                        Email *:</label>
                                    <div class="col-sm-3">
                                        <input required="" value="<?=$current_user->email?>" name="email" class="form-control" type="text"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        <i class="fa fa-mobile-phone"></i>
                                        Телефон *:</label>
                                    <div class="col-sm-3">
                                        <input required="" value="<?=$current_user->phone?>" name="phone" class="form-control phone-mask" type="text"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        <i class="fa fa-eye-slash"></i>
                                        Новый пароль :</label>
                                    <div class="col-sm-3">
                                        <input  name="password" class="form-control" type="password"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">
                                        <i class="fa fa-eye-slash"></i>
                                        Подтвердите новый пароль:</label>
                                    <div class="col-sm-3">
                                        <input  name="password_confirmation" class="form-control" type="password"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-pencil"></i>
                                            Сохранить
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>	<!-- /container -->




@endsection
