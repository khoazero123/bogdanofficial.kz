<?
    $nav = array(
        array(
            'title' => 'Информация о счете',
            'link' => '/personal'
        ),
        array(
            'title' => 'Покупка подписки',
            'link' => '/personal/subscription'
        ),
        array(
            'title' => 'Пополнить счёт',
            'link' => '/personal/payment'
        ),
        array(
            'title' => 'Личные данные',
            'link' => '/personal/data'
        )
    );
?>
<br/>
<ul class="nav nav-tabs">
    <?foreach($nav as $item){?>
        <li class="
            <?if('/'.Request::path() == $item['link']){?>active<?}?>
            ">
                <a href="{{$item['link']}}">{{$item['title']}}</a>
        </li>
    <?}?>
</ul>