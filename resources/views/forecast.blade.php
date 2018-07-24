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
                <div class="col-md-12">
                    <ul class="nav nav-tabs forecaster-people-tab">
                        <li <?if($code_forecaster_people == ''){?>class="active"<?}?>><a href="/forecast">Все</a></li>
                        <?foreach($forecasterPeople as $item){?>
                            <li
                                <?if($item->code == $code_forecaster_people){?>class="active"<?}?>
                                ><a href="/forecast/<?=$item->code?>"><?=$item->fullname?></a></li>
                        <?}?>
                    </ul>
                </div>

                <div class="col-md-12">
                    <?
                    $i = 0;
                    foreach($forecast as $key => $item){
                        $i++;

                        //предсказатель
                        $forecasterPeople = $item->ForecasterPeople;

                        //ссылка
                        $detail_url = '/forecast/' . $forecasterPeople->code .'/'. $item['code'];
                        ?>
                        <?if($i==1){?><div class="row"><?}?>
                            <div class="col-sm-3 item-row">
                                <div class="border">
                                    <a  href="<?=$detail_url?>">
                                        <img src="/upload/<?=$item->image?>" alt="<?=$item->title?>">
                                    </a>
                                    <a href="<?=$detail_url?>">
                                        <div class="title">
                                            <?=$item->title?><br>
                                            <span>от <?=$forecasterPeople->fullname?></span>
                                        </div>
                                        <div class="date  <?=(time() <= strtotime($item->date)) ? ' current ' : ''?>">
                                            <?=date('d.m.Y', strtotime($item->date))?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?if($i==4 or $key+1 == count($forecast)){?></div><?$i = 0;}?>
                    <?}?>
                </div>

            </div>

            <div class="pagination-bottom"><?=$forecast->links();?></div>


        </article>
        <!-- /Article -->

    </div>
</div>	<!-- /container -->




@endsection
