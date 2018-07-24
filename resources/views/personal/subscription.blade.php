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

        <div class="col-sm-12 ">

            @include('personal.layouts.tab')

            <div class="tab-content clearfix">
                <div  class="tab-pane fade in active">
                    <div class="panel  panel-default">
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
                                    <label class="col-sm-2 control-label"><i class="fa fa-calendar"></i> Выберите тариф :</label>
                                    <div class="col-sm-3">
                                        <?foreach($subscription_type as $key => $v){?>
                                            <div class="radio radio-primary">
                                                <input
                                                    id="sub<?=$key?>"
                                                    <?if($key == 0) echo ' checked ';?>
                                                    type="radio"
                                                    name="subscription"
                                                    value="<?=$v->id?>"/>

                                                <label for="sub<?=$key?>">
                                                    <?=$v->title?>
                                                    <?=$v->price?> тг
                                                </label>
                                            </div>
                                        <?}?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-3">

                                            <button type="submit" class="btn btn-success">
                                                <i class="fa fa-credit-card"></i>
                                                Купить
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
