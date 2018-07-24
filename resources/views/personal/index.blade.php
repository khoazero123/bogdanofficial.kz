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
                <div class="tab-pane fade in active">

                    <div class="panel  panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td >
                                                <i class="fa fa-money"></i>
                                                <b>На счёте:</b>
                                            </td>
                                            <td>
                                                <?=$account?> KZT
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="fa fa-calendar"></i>
                                                <b>Вы подписалис до:</b>&nbsp;&nbsp;
                                            </td>
                                            <td>
                                                <?=$max_end_date ? date("d.m.Y H:i:s", strtotime($max_end_date)) : ''?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="fa fa-calendar-o"></i>
                                                <b>Осталось дней:</b>
                                            </td>
                                            <td>
                                                <?=$days_left?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>	<!-- /container -->




@endsection
