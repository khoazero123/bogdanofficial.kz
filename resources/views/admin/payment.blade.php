@extends('admin.layouts.app')

@section('content')


<div class="row">
            <div class="col-12">


<div class="card mb-3 ng-scope">
    <div class="card-body">



        <div class="table-responsive">
            <form method="get" action="">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>
                                <select class="form-control" name="ok" onchange="$('form').submit()">
                                    <option <?if(!$request['ok']){?>selected=""<?}?>     value="all">Все</option>
                                    <option <?if($request['ok'] == 1){?>selected=""<?}?> value="1">Оплачено</option>
                                    <option <?if($request['ok'] == 0){?>selected=""<?}?> value="0">Не оплачено</option>
                                </select>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>
                                <button type="submit" class="btn btn-info">
                                    <i class="fa fa-cogs"></i>
                                    Фильтр
                                </button>
                            </th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Сумма</th>
                            <th>Комиссия</th>
                            <th>Статус</th>
                            <th>Результат</th>
                            <th>Дата создания</th>
                            <th>Ответа сервера</th>
                            <th>Пользователь</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Сумма</th>
                            <th>Комиссия</th>
                            <th>Статус</th>
                            <th>Результат</th>
                            <th>Дата создания</th>
                            <th>Ответа сервера</th>
                            <th>Пользователь</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?foreach($payment as $key => $item){?>
                            <tr>
                                <td><?=$item->id?></td>
                                <td><?=$item->sum?> тг</td>
                                <td><?=$item->commission?> тг</td>
                                <td><?=$item->ok == 1 ? '<span class="badge badge-success">Оплачено</span>' : '<span class="badge badge-danger">Не оплачено</span>'?></td>
                                <td>
                                    <?if(!empty($item->result)){?>
                                        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#result<?=$key?>">
                                            <i class="fa fa-info-circle"></i>
                                            Показать
                                        </button>
                                        <div id="result<?=$key?>" class="collapse">
                                            <p>
                                                <?Helper::p(json_decode($item->result))?>
                                            </p>
                                        </div>
                                    <?}?>
                                </td>
                                <td><?=Helper::date_standard($item->created_at)?></td>
                                <td><?=Helper::date_standard($item->updated_at)?></td>
                                <td><a href="/admin/user/save/<?=$item->user_id?>">
                                        <i class="fa fa-external-link-square"></i>
                                        <?=$item->user->name?>
                                    </a>
                                </td>
                            </tr>
                        <?}?>
                    </tbody>
                </table>
            </form>
        </div>

        <div class="pagination-bottom">
            <?=$payment->links();?>
        </div>

    </div>
</div>

</div>
</div>




@endsection
