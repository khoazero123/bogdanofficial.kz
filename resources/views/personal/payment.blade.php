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


                            <form method="POST" action="/personal/paymentpay" class="form-horizontal">

                                 {{csrf_field()}}

                                 <div class="form-group">
                                     <label class="col-sm-2 control-label">
                                         <i class="fa fa-money"></i>
                                         Сумма:</label>
                                     <div class="col-sm-3">
                                         <input
                                             ng-init="sum=7000"
                                             required="" min="0"  ng-model="sum" name="sum" class="form-control" type="number"/>
                                     </div>


                                 </div>

                                 <div class="form-group">
                                     <label class="col-sm-2 control-label"></label>
                                     <div class="col-sm-3">
                                         <button type="submit" class="btn btn-success">
                                             <i class="fa fa-credit-card"></i>
                                             Пополнить счёт
                                         </button>
                                     </div>
                                 </div>
                                <div class="form-group">
                                    <div class="col-sm-5 text-right">
                                        <p class="label label-info">Комиссия банка(2.9%): Итого: @{{sum}} + @{{sum * 0.029}} = @{{sum + (sum * 0.029)}}  тг</p>
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
