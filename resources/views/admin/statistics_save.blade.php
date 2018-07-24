@extends('admin.layouts.app')

@section('content')


<div class="row">
            <div class="col-12">


<div class="card mb-3 ng-scope">
    <div class="card-body">
        <div class="col-lg-6 col-xs-12">

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

        <form method="post" enctype="multipart/form-data" action="">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="form-group ">
                    <label class="col-form-label col-xs-3">Название</label>
                    <input name="data[title]" required="" type="text" class="form-control" value="<?=$statistics ? $statistics->title : ''?>">
                </div>
                <div class="form-group ">
                    <label class="col-form-label col-xs-3">Прогнозист</label>
                    <select required="" name="data[id_forecaster_people]" class="form-control">
                        <?foreach($forecaster_people as $item){?>
                            <option
                                <?
                                if($statistics)
                                if($item->id == $statistics->id_forecaster_people){?>selected<?}?>
                                value="<?=$item->id?>"><?=$item->fullname?></option>
                        <?}?>
                    </select>
                </div>
                <div class="form-group ">
                    <label class="col-form-label col-xs-3">Дата</label>
                    <input name="data[date]" required="" type="text" class="form-control datetimepicker"  value="<?=$statistics ? $statistics->date : ''?>">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Фото:</label>
                    <input class="form-control" type="file"  name="data[image]" <?if(empty($statistics->image)){?>required="" <?}?>/>
                    <?if(isset($statistics->image)){?>
                        <img class="border-image" src="/upload/<?=$statistics->image?>" width="100"/>
                    <?}?>
                </div>

                <div class="form-group ">
                    <label class="col-form-label col-xs-3">Автивно</label>
                    <input
                        style="width:30px"
                        <?
                        if($statistics){
                            if($statistics->active == 1){?>checked="" <?}
                        }else {?>
                            checked=""
                        <?}
                    ?>

                        name="data[active]" type="checkbox" class="form-control" value="1"/>
                </div>
                <div class="form-group ">
                    <a href="/admin/statistics" class="btn btn-secondary">Закрыть</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>

        </form>
        </div>
    </div>
</div>

</div>
</div>




@endsection
