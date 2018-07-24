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
                    <?
                    $i = 0;
                    foreach($blog as $key => $item){
                        $i++;


                        //ссылка
                        $detail_url = '/blog/' . $item['code'];
                        ?>
                        <?if($i==1){?><div class="row"><?}?>
                            <div class="col-sm-3 item-row">
                                <div class="border">
                                    <a  href="<?=$detail_url?>">
                                        <img style="height: auto" src="/upload/<?=$item->image?>" alt="<?=$item->title?>">
                                    </a>
                                    <a href="<?=$detail_url?>">
                                        <div class="title">
                                            <?=$item->title?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?if($i==4 or $key+1 == count($blog)){?></div><?$i = 0;}?>
                    <?}?>
                </div>

            </div>

            <div class="pagination-bottom"><?=$blog->links();?></div>


        </article>
        <!-- /Article -->

    </div>
</div>	<!-- /container -->




@endsection
