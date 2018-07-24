@extends('admin.layouts.app')

@section('content')


<div class="row">
            <div class="col-12">


<div class="card mb-3 ng-scope">
    <div class="card-body">

        <div class="form-group">
            <div class="row">
                <div class="col-sm-2">
                    <a href="/admin/user/save/" class="btn btn-primary">Создать <i class="fa fa-plus-circle"></i></a>
                </div>
            </div>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>E-mail</th>
                    <th>Телефон</th>
                    <th>Роль</th>
                    <th>На счёте</th>
                    <th>Подписано до</th>
                    <th>Осталось дней</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>E-mail</th>
                    <th>Телефон</th>
                    <th>Роль</th>
                    <th>На счёте</th>
                    <th>Подписано до</th>
                    <th>Осталось дней</th>
                    <th>Действие</th>
                </tr>
                </tfoot>
                <tbody>
                    <?foreach($users as $item){?>
                        <tr>
                            <td><?=$item->id?></td>
                            <td><?=$item->name?></td>
                            <td><?=$item->email?></td>
                            <td><?=$item->phone?></td>
                            <td>
                                <?foreach($item->roles as $role){
                                    echo $role->description;
                                }?>
                            </td>

                            <td>
                                <?
                                //подписка
                                $subscription_sum = App\Subscription::where('user_id', $item->id)->sum('price');
                                //пополнил счет
                                $payment_sum      = App\Payment::where('user_id', $item->id)->where('ok', 1)->sum('sum');

                                echo $payment_sum - $subscription_sum > 0 ? $payment_sum - $subscription_sum . ' тг' : '';
                                ?>
                            </td>
                            <td>
                                <?

                                $max_end_date = App\Subscription::where('user_id', $item->id)->max(DB::raw('DATE_ADD(start_date, INTERVAL day DAY)'));
                                echo $max_end_date ? \App\Helpers\Helper::date_standard($max_end_date) : '';
                                ?>
                            </td>
                            <td>
                                <?
                                $days_left = App\Subscription::where('user_id', $item->id)
                                    ->where(DB::raw('DATE_ADD(start_date, INTERVAL day DAY)'), '>=', date("Y.m.d H:i:s"))
                                    ->sum('day');
                                echo $days_left > 0 ? $days_left : '';
                                ?>
                            </td>

                            <td>
                                <?if($item->id != Auth::id())
                                {?>
                                    <a class="fa fa-remove fa-error" href="/admin/user/delete/<?=$item->id?>"></a>
                                    &nbsp;
                                    &nbsp;
                                    &nbsp;
                                    &nbsp;
                                <?}?>
                                <a class="fa fa-pencil-square-o fa-success" href="/admin/user/save/<?=$item->id?>"></a>
                            </td>
                        </tr>
                    <?}?>
                </tbody>
            </table>
        </div>

        <div class="pagination-bottom">
            <?=$users->links();?>
        </div>
    </div>
</div>

</div>
</div>




@endsection
