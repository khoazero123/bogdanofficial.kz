@extends('layouts.app')

@section('content')




<header id="head" class="secondary"></header>

<!-- container -->
<div class="container">

    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
        <li class="active"><?=$title?></li>
    </ol>

    <div class="row">

        <!-- Article main content -->
        <article class="col-xs-12 maincontent">
            <header class="page-header">
                <h1 class="page-title"><?=$title?></h1>
            </header>
            <div class="row">


                <?foreach($live as $item){
                    $forecaster_people = $item->ForecasterPeople;
                    ?>
                    <div class="col-sm-12 live-row">
                        <div class="border <?=$item->type == 1 ? 'bet-ok' : ''?>">
                            <img src="/upload/<?=$forecaster_people->image?>" alt="<?=$item->fullname?>">
                            <div class="info">
                                <div class="title">
                                    <?=$item->title?>
                                    <div class="status <?=$item->type == 0 ? 'wait' : 'bet-ok'?>">
                                        <?=$item->type == 0 ? 'Ожидает результата' : 'Ставка сыграла'?>
                                    </div>
                                </div>
                                <div class="description">

                                    <?if(Auth::check()){?>
                                        Результат:
                                        <?if($days_left){
                                            echo $item->result;
                                        }else{?>
                                            <a class="btn btn-success"  href="/personal/payment">
                                                <i class="fa fa-credit-card"></i>
                                                Купить
                                            </a>
                                        <?}?>
                                    <?}else{?>
                                        <p>Прогноз могут просматривать только зарегистрированные пользователи.</p>
                                    <?}?>

                                </div>
                                <div class="date"> <?=date('d.m.Y H:i:s', strtotime($item->date))?>, по времени <?=$item->date_zone?></div>
                            </div>
                        </div>
                    </div>
                <?}?>


            </div>
            <div class="pagination-bottom"><?=$live->links();?></div>


        </article>
        <!-- /Article -->

    </div>
</div>	<!-- /container -->




@endsection
