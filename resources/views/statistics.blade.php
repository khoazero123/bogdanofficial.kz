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
                <?foreach($statistics as $item){?>
                    <div class="col-sm-12 statistics-row">
                        <div class="border">
                            <div class="info">
                                <div class="title">
                                    <?=$item->title?> от  <span><?=$item->ForecasterPeople->fullname?></span>
                                </div>
                                <div class="date"> <?=date('d.m.Y', strtotime($item->date))?></div>
                            </div>
                            <img src="/upload/<?=$item->image?>" alt="<?=$item->title?>">
                        </div>
                    </div>
                <?}?>
            </div>
            <div class="pagination-bottom"><?=$statistics->links();?></div>



        </article>
        <!-- /Article -->

    </div>
</div>	<!-- /container -->




@endsection
