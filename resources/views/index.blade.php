@extends('layouts.app')


<!-- Header -->
<header id="head">
    <div class="container">
        <div class="row">
            <h1 class="lead">Bogdanofficial</h1>
            <p class="tagline"></p>
            <p>
                <a href="/forecast" class="btn btn-default btn-lg" role="button">Прогнозы</a>
            </p>
        </div>
    </div>
</header>
<!-- /Header -->

@section('content')


<div class="main-video" >
    <div class="col-sm-4">
        <iframe width="100%" height="315"
                src="https://www.youtube.com/embed/CRggeA4-wYk">
        </iframe>
    </div>
    <div class="col-sm-4">
        <iframe width="100%" height="315"
                src="https://www.youtube.com/embed/0MycU0loRSc">
        </iframe>
    </div>
    <div class="col-sm-4">
        <iframe width="100%" height="315"
                src="https://www.youtube.com/embed/LXNShiJsmgI">
        </iframe>
    </div>
    <div class="col-sm-12">
        <a href="https://www.youtube.com/">Bogdanofficial на YouTube</a>
    </div>
</div>



<!-- container -->
<div class="container">

    <h2 class="text-center top-space">Статьи</h2>
    <br>


    <?

    $i = 0;
    foreach($blog as $key => $blog_item){
        $i++;
        ?>
        <?if($i==1){?><div class="row"><?}?>
        <div class="col-sm-6">
            <h3><a href="<?='/blog/' . $blog_item['code']?>"><?=$blog_item->title?></a></h3>
            <p><?=Helper::limit_text($blog_item->text, 20)?></p>
        </div>
        <?if($i==2 or $key+1 == count($blog)){?></div><?$i = 0;}?>
    <?}?>


</div>	<!-- /container -->



<!-- Highlights - jumbotron -->
<div class="jumbotron top-space">
    <div class="container">

        <h3 class="text-center thin">Bogdanofficial это</h3>

        <div class="row">
            <div class="col-md-3 col-sm-6 highlight">
                <div class="h-caption"><h4><i class="fa fa-check-circle fa-5"></i>Доверие</h4></div>
                <div class="h-body text-center">
                    <p>
                        Нам доверяют сотни тысяч людей по всему СНГ. Посещаемость №1 в социальной сети Вконтакте: 900.000 подписчиков.
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 highlight">
                <div class="h-caption"><h4><i class="fa fa-signal fa-5"></i>Аналитики</h4></div>
                <div class="h-body text-center">
                    <p>Наши аналитики сделали миллионы чистой прибыли и будут делиться с Вами авторитетным мнением!</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 highlight">
                <div class="h-caption"><h4><i class="fa fa-heart fa-5"></i>Всегда с собой</h4></div>
                <div class="h-body text-center">
                    <p>Моментальные push уведомления о новом прогнозе! Удобство во всем! Ищите в App Store и GooglePlay под названием FAQBET</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 highlight">
                <div class="h-caption"><h4><i class="fa fa-smile-o fa-5"></i>Статистика прохода</h4></div>
                <div class="h-body text-center">
                    <p>Специальный раздел сайта позволит следить за работой всех прогнозистов самостоятельно.</p>
                </div>
            </div>
        </div> <!-- /row  -->

    </div>
</div>
<!-- /Highlights -->


<div class="container">
    <div class="jumbotron top-space banner">
        <div class="col-sm-12">
            <img src="https://s3.eu-central-1.amazonaws.com/fb-bookmakers/1xstavkabig.gif" class="big-banner-image">
        </div>
    </div>
</div>




@endsection
