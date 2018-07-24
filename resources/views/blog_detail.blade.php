@extends('layouts.app')

@section('content')




<header id="head" class="secondary"></header>

<!-- container -->
<div class="container">

    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
        <li><a href="/blog">Блог</a></li>
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
                    <img src="/upload/<?=$blog->image?>">
                </div>

                <div class="col-md-9">
                    <?=$blog->text?>
                </div>
            </div>



        </article>
        <!-- /Article -->

    </div>
</div>	<!-- /container -->




@endsection
