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



                     <div class="panel-group" id="accordion">

                         <?foreach($faq as $key => $item){?>
                             <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$key?>"><?=$item->title?></a>
                                    </h4>
                                </div>
                                <div id="collapse<?=$key?>" class="panel-collapse collapse <?=$key == 0 ? 'in' : ''?>">
                                    <div class="panel-body">
                                        <?=$item->text?>
                                    </div>
                                </div>
                            </div>
                         <?}?>

                    </div>



            </div>




        </article>
        <!-- /Article -->

    </div>
</div>	<!-- /container -->




@endsection
