@extends('admin.layouts.app')

@section('content')


<div class="row">
            <div class="col-12">


<div class="card mb-3">
    <div class="card-body">
        <div class="col-lg-12 col-xs-12">

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#info">Информация о пользователе</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#payment">Пополнение счета</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#subscription">Покупка подписки</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane  active" id="info">
                    <div class="row">
                        <div class="col-lg-6">
                            <form method="post" enctype="multipart/form-data" action="">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <div class="form-group ">
                                    <label class="col-form-label col-xs-3">Название</label>
                                    <input name="name" required="" type="text" class="form-control" value="<?=$user ? $user->name : ''?>">
                                </div>
                                <div class="form-group ">
                                    <label class="col-form-label col-xs-3">Email</label>
                                    <input name="email" required="" type="text" class="form-control" value="<?=$user ? $user->email : ''?>">
                                </div>
                                <div class="form-group ">
                                    <label class="col-form-label col-xs-3">Телефон</label>
                                    <input name="phone" required="" type="text" class="form-control phone-mask" value="<?=$user ? $user->phone : ''?>">
                                </div>

                                <div class="form-group ">
                                    <label class="col-form-label col-xs-3">Новый пароль</label>
                                    <input <?=!$user ? 'required=""' : ''?> name="password" type="text" class="form-control" value="">
                                </div>
                                <div class="form-group ">
                                    <label class="col-form-label col-xs-3">Повторите пароль</label>
                                    <input <?=!$user ? 'required=""' : ''?> name="password_confirmation" type="text" class="form-control" value="">
                                </div>



                                <div class="form-group ">
                                    <label class="col-form-label col-xs-3">Роль</label>
                                    <select required="" name="role_id" class="form-control">
                                        <?foreach($roles as $item){?>
                                            <option

                                                <?
                                                if($user_role)
                                                {
                                                    if($user_role->role_id == $item->id)
                                                    {
                                                        echo ' selected ';
                                                    }
                                                }
                                                ?>
                                                value="<?=$item->id?>"><?=$item->description?></option>
                                        <?}?>
                                    </select>
                                </div>

                                <div class="form-group ">
                                    <a href="/admin/user" class="btn btn-secondary">Закрыть</a>
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
                <div class="tab-pane  fade" id="payment">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Сумма</th>
                                    <th>Статус</th>
                                    <th>Дата</th>
                                    <th>Результат</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Сумма</th>
                                    <th>Статус</th>
                                    <th>Дата</th>
                                    <th>Результат</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?foreach($payment as $key => $item){?>
                                    <tr>
                                        <td><?=$item->id?></td>
                                        <td><?=$item->sum?></td>
                                        <td><?=$item->ok == 1 ? '<span class="badge badge-success">Оплачено</span>' : '<span class="badge badge-danger">Не оплачено</span>'?></td>
                                        <td><?=Helper::date_standard($item->created_at);?></td>
                                        <td>



                                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#result<?=$key?>">Показать</button>
                                            <div id="result<?=$key?>" class="collapse">
                                                <p>
                                                    <?Helper::p(json_decode($item->result))?>
                                                </p>
                                            </div>

                                        </td>
                                    </tr>





                                <?}?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane  fade" id="subscription">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Дата покупки</th>
                                <th>Дата начало</th>
                                <th>Тариф</th>
                                <th>Цена</th>
                                <th>Кол-во дней</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Дата покупки</th>
                                <th>Дата начало</th>
                                <th>Тариф</th>
                                <th>Цена</th>
                                <th>Кол-во дней</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?foreach($subscription as $key => $item){?>
                                <tr>
                                    <td><?=$item->id?></td>
                                    <td><?=Helper::date_standard($item->created_at)?></td>
                                    <td><?=Helper::date_standard($item->start_date)?></td>
                                    <td><?=$item->SubscriptionType->title;?></td>
                                    <td><?=$item->price?></td>
                                    <td><?=$item->day?></td>
                                </tr>
                            <?}?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




        </div>



    </div>
</div>

</div>
</div>




@endsection
