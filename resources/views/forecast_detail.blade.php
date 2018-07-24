@extends('layouts.app')

@section('content')




<header id="head" class="secondary"></header>

<!-- container -->
<div class="container">

    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
        <li><a href="/forecast">Прогнозы</a></li>
        <li class="active"><?=$title?></li>
    </ol>

    <div class="row">

        <!-- Article main content -->
        <article class="col-xs-12 maincontent">
            <header class="page-header">
                <h1 class="page-title"><?=$title?></h1>
            </header>
            <div class="row forecast_detail">
                <div class="col-md-3">
                    <img src="/upload/<?=$forecast->image?>">
                </div>

                <div class="col-md-9">
                    <?if(Auth::check()){?>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Дата</label>
                            <div class="col-sm-10">
                                <?=date('d.m.Y H:i', strtotime($forecast->date))?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Прогнозист</label>
                            <div class="col-sm-10">
                                <?=$forecast->ForecasterPeople->fullname?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Описание</label>
                            <div class="col-sm-10">
                                <?=$forecast->description?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Результат</label>
                            <div class="col-sm-10">
                                <?if($days_left){
                                    echo $forecast->result;
                                }else{?>
                                    <a class="btn btn-success"  href="/personal/payment">
                                        <i class="fa fa-credit-card"></i>
                                        Купить
                                    </a>
                                <?}?>
                            </div>
                        </div>
                    <?}else{?>
                        <p>Прогноз могут просматривать только зарегистрированные пользователи.</p>
                    <?}?>
                </div>
            </div>



        </article>
        <!-- /Article -->

    </div>
</div>	<!-- /container -->




@endsection
