<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- JavaScript libs are placed at the end of the document so the pages load faster -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- panel main css -->
    <link rel="stylesheet" type="text/css" href="/admin-all/css/style.css" />
    <!-- admin style -->
    <link href="/admin-all/css/sb-admin.css" rel="stylesheet">

    <title>{{isset($title) ? $title : ''}}</title>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">


<?
$menu = array(

    array(
        'link' => '/admin/forecast/',
        'title' => 'Прогнозы',
        'icon' => 'fa fa-newspaper-o'
    ),
    array(
        'link' => '/admin/statistics/',
        'title' => 'Статистика',
        'icon' => 'fa fa-signal'
    ),
    array(
        'link' => '/admin/forecaster-people/',
        'title' => 'Прогнозисты',
        'icon' => 'fa fa-users'
    ),
    array(
        'link' => '/admin/blog/',
        'title' => 'Блог',
        'icon' => 'fa fa-book'
    ),
    array(
        'link' => '/admin/faq/',
        'title' => 'FAQ',
        'icon' => 'fa fa-question-circle'
    ),
    array(
        'link' => '/admin/live/',
        'title' => 'LIVE',
        'icon' => 'fa fa-tv'
    ),
    array(
        'link' => '/admin/user/',
        'title' => 'Список пользователей',
        'icon' => 'fa fa-user'
    ),
    array(
        'link' => '/admin/subscription-type/',
        'title' => 'Тарифы',
        'icon' => 'fa fa-book'
    ),
    array(
        'link' => '/admin/payment/',
        'title' => 'Оплаты',
        'icon' => 'fa fa-credit-card'
    )

);

?>


<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">

    <a class="navbar-brand" href="/admin/">
        <img src="/images/logo.svg" alt="" height="37"/>
    </a>

    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

            <?foreach($menu as $item){?>



                <li class="nav-item
                <?if(strpos('/'.Request::path().'/', $item['link']) !== false){?>active<?}?>"
                    data-toggle="tooltip" data-placement="right" title="Новости">
                    <a class="nav-link" href="<?=$item['link']?>">
                        <i class="<?=$item['icon']?>"></i>
                        <span class="nav-link-text"><?=$item['title']?></span>
                    </a>
                </li>
            <?}?>

        </ul>



        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/" title="На главную страницу">
                    <i class="fa fa-home"></i>
                    Сайт
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/user" title="Список пользователей">
                    <i class="fa fa-user"></i>
                    {{ Auth::user()->name }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();" title="Выйти из сайта">
                    <i class="fa fa-fw fa-sign-out"></i>Выход
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>



    </div>
</nav>


<div class="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <?foreach($breadcrumb as $item){?>
                <?if(empty($item['link'])){?>
                    <li class="breadcrumb-item active">{{isset($title) ? $title : ''}}</li>
                <?}else{?>
                    <li class="breadcrumb-item">
                        <a href="<?=$item['link']?>">
                            <?=$item['title']?>
                        </a>
                    </li>
                <?}?>
            <?}?>
        </ol>
        <div class="row">
            <div class="col-12">
                @yield('content')
            </div>
        </div>
    </div>
</div>


<footer class="sticky-footer">
    <div class="container">
        <div class="text-center">
            <small>Bogdanofficial &copy; <?=date('Y')?></small>
        </div>
    </div>
</footer>


<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.js"></script>
<script>
    /* Russian (UTF-8) initialisation for the jQuery UI date picker plugin. */
    /* Written by Andrew Stromnov (stromnov@gmail.com). */
    ( function( factory ) {
        if ( typeof define === "function" && define.amd ) {

            // AMD. Register as an anonymous module.
           // define( [ "../widgets/datepicker" ], factory );
        } else {

            // Browser globals
            factory( jQuery.datepicker );
        }
    }( function( datepicker ) {
        datepicker.regional.ru = {
            closeText: "Закрыть",
            prevText: "&#x3C;Пред",
            nextText: "След&#x3E;",
            currentText: "Сегодня",
            monthNames: [ "Январь","Февраль","Март","Апрель","Май","Июнь", "Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь" ],
            monthNamesShort: [ "Янв","Фев","Мар","Апр","Май","Июн", "Июл","Авг","Сен","Окт","Ноя","Дек" ],
            dayNames: [ "воскресенье","понедельник","вторник","среда","четверг","пятница","суббота" ],
            dayNamesShort: [ "вск","пнд","втр","срд","чтв","птн","сбт" ],
            dayNamesMin: [ "Вс","Пн","Вт","Ср","Чт","Пт","Сб" ],
            weekHeader: "Нед",
            dateFormat: "dd.mm.yy",
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: "" };
        datepicker.setDefaults( datepicker.regional.ru );
        return datepicker.regional.ru;
    } ) );
</script>
<script type="text/javascript">
    $(function(){
        $(".datetimepicker").datetimepicker({
            showSecond: false,
            dateFormat: 'yy-mm-dd',
            timeFormat: 'hh:mm:ss',
            firstDay: 1
        });
    });
</script>
<script src="/js/jquery.maskedinput.min.js"></script>
<!-- all js -->
<script type="text/javascript" src="/admin-all/js/script.js"></script>


<script src="/ckeditor/ckeditor.js"></script>

<script>
    CKEDITOR.replaceClass = 'ckeditor';
</script>

</body>
</html>