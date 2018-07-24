<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport"    content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">

    <title>{{isset($title) ? $title : ''}}</title>

    <link rel="shortcut icon" href="/images/logo.PNG">

    <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">

    <!-- Custom styles for our template -->
    <link rel="stylesheet" href="/css/bootstrap-theme.css" media="screen" >
    <link rel="stylesheet" href="/css/main.css?r=<?=rand()?>">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120079626-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-120079626-1');
    </script>


</head>


<body class="home" ng-app="Main" ng-controller="MainCntrl">

<?
$menu = array(

        array(
            'link' => '/forecast/',
            'title' => 'Прогнозы',
        ),
        array(
            'link' => '/statistics/',
            'title' => 'Статистика',
        ),
        array(
            'link' => '/forecaster-people/',
            'title' => 'Прогнозисты',
        ),
        array(
            'link' => '/blog/',
            'title' => 'Блог',
        ),
        array(
            'link' => '/faq/',
            'title' => 'FAQ',
        ),
        array(
            'link' => '/live/',
            'title' => 'LIVE',
        )
);

?>

<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top headroom" >
    <div class="container">
        <div class="navbar-header">
            <!-- Button for smallest screens -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand" href="/">
                <img height="50" style="margin-top: -15px;" src="/images/logo.PNG" alt="Progressus HTML5 template">
            </a>
        </div>
        <div class="navbar-collapse collapse" style="overflow-y: unset;">
            <ul class="nav navbar-nav pull-right">

                <li class="<?if(Request::path() == '/'){?>active<?}?>">
                    <a href="/">Главная</a>
                </li>

                <?foreach($menu as $menu_item){?>
                    <li class="<?if(strpos('/'.Request::path().'/', $menu_item['link']) !== false and Request::path() != '/'){?>active<?}?>">
                        <a href="<?=$menu_item['link']?>"><?=$menu_item['title']?></a>
                    </li>
                <?}?>

                <?if(Auth::check()){?>
                    <li>
                        <a title="Выйти из системы" class="fa fa-sign-out" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                <?}?>

                    <?if(Auth::check()){?>
                        <li>
                            <a class="btn" href="/personal">
                                {{ Auth::user()->name }}
                            </a>
                        </li>

                        <?if(Auth::user()->hasRole('admin')){?>
                            <li>
                                <a class="btn" href="/admin">
                                    Панель администратора
                                </a>
                            </li>
                        <?}?>

                    <?}else{?>
                        <li>
                            <a class="btn" href="/login">
                                <i class="fa fa-sign-out"></i>
                                Авторизация
                            </a>
                        </li>
                        <li>
                            <a class="btn" href="/register">
                                <i class="fa fa-user"></i>
                                Регистрация
                            </a>
                        </li>
                    <?}?>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
<!-- /.navbar -->


@yield('content')



<footer id="footer" class="top-space">

    <div class="footer1">
        <div class="container">
            <div class="row">

                <div class="col-md-3 widget">
                    <h3 class="widget-title">Контакты</h3>
                    <div class="widget-body">
                        <p>
                            По вопросам рекламы или сотрудничества пишите на <a href="mailto:Bagaofficial01@gmail.com">Bagaofficial01@gmail.com</a>
                            <br>
                            <br>
                            Режим работы: ПН-ПТ | 13:00-0:00 АСТ | 10:00-21:00 МСК
                        </p>
                    </div>
                </div>

                <div class="col-md-3 widget">
                    <h3 class="widget-title">Мы в социальных сетях</h3>
                    <div class="widget-body">
                        <p class="follow-me-icons">
                            <a target="_blank" href="https://www.instagram.com/bogdanofficial02/"><i class="fa fa-instagram fa-2"></i></a>
                            <a target="_blank" href="https://vk.com/bogdanifficial01"><i class="fa fa-vk fa-2"></i></a>
                        </p>
                    </div>
                </div>

                <div class="col-md-3 widget">
                    <h3 class="widget-title">Кто мы</h3>
                    <div class="widget-body">
                        <p>Нам доверяют сотни тысяч людей по всему СНГ. Посещаемость №1 в социальной сети Вконтакте: 900.000 подписчиков.</p>
                    </div>
                </div>

                <div class="col-md-3 widget">
                    <h3 class="widget-title">Мы принимаем</h3>
                    <div class="widget-body">
                        <p><img src="https://paybox.kz/assets/pp/images/pay_color.svg"></p>
                    </div>
                </div>

            </div> <!-- /row of widgets -->
        </div>
    </div>

    <div class="footer2">
        <div class="container">
            <div class="row">

                <div class="col-md-6 widget">
                    <div class="widget-body">
                        <p class="simplenav">
                            <?foreach($menu as $menu_item){?>
                                <a href="<?=$menu_item['link']?>"><?=$menu_item['title']?></a>
                            <?}?>
                        </p>
                    </div>
                </div>

                <div class="col-md-6 widget">
                    <div class="widget-body">
                        <p class="text-right">
                            Copyright &copy; <?=date('Y')?>, все права защищены</a>
                        </p>
                    </div>
                </div>

            </div> <!-- /row of widgets -->
        </div>
    </div>

</footer>





<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

<script src="/js/jquery.maskedinput.min.js"></script>
<script src="/js/headroom.min.js"></script>
<script src="/js/jQuery.headroom.min.js"></script>
<script src="/js/template.js"></script>
</body>
</html>