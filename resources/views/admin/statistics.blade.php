@extends('admin.layouts.app')

@section('content')


<div class="row">
            <div class="col-12">


<div class="card mb-3 ng-scope">
    <div class="card-body">

        <div class="form-group">
            <div class="row">
                <div class="col-sm-2">
                    <a href="/admin/statistics/save/" class="btn btn-primary">Создать <i class="fa fa-plus-circle"></i></a>
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
                    <th>Название</th>
                    <th>Прогнозист</th>
                    <th>Дата</th>
                    <th>Фото</th>
                    <th>Автивно</th>
                    <th>Действие</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Прогнозист</th>
                    <th>Дата</th>
                    <th>Фото</th>
                    <th>Автивно</th>
                    <th>Действие</th>
                </tr>
                </tfoot>
                <tbody>
                    <?foreach($statistics as $item){?>
                        <tr>
                            <td><?=$item->id?></td>
                            <td><?=$item->title?></td>
                            <td><?=$item->ForecasterPeople->fullname?></td>
                            <td><?=Helper::date_standard($item->date)?></td>
                            <td>
                                <img src="/upload/<?=$item->image?>" width="100"/>
                            </td>
                            <td>
                                <i class="fa <?=$item->active == 1 ? 'fa-success fa-eye' : 'fa-error fa-eye-slash'?>"></i>
                            </td>
                            <td>
                                <a class="fa fa-remove fa-error" href="/admin/statistics/delete/<?=$item->id?>"></a>
                                &nbsp;
                                <a class="fa fa-pencil-square-o fa-success" href="/admin/statistics/save/<?=$item->id?>"></a>
                            </td>
                        </tr>
                    <?}?>
                </tbody>
            </table>
        </div>

        <div class="pagination-bottom">
            <?=$statistics->links();?>
        </div>
    </div>
</div>

</div>
</div>




@endsection
