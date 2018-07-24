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
                <?foreach($forecaster_people as $item){?>
                    <div class="col-sm-6 forecaster-people-row">
                        <div class="border">
                            <img src="/upload/<?=$item->image?>" alt="<?=$item->fullname?>">
                            <div class="info">
                                <div class="title">
                                    <?=$item->fullname?>
                                </div>
                                <div class="description">
                                    <?=$item->description?>
                                </div>
                            </div>

                        </div>
                    </div>
                <?}?>
            </div>




        </article>
        <!-- /Article -->

    </div>
</div>	<!-- /container -->




@endsection
