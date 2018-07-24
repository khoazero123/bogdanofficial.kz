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
                    <input
                        onchange="traslate(this, $('input[name=code]'))"
                        onkeypress="traslate(this, $('input[name=code]'))"
                        name="fullname" required="" type="text" class="form-control" value="<?=$forecaster_people ? $forecaster_people->fullname : ''?>">
                </div>
                <div class="form-group ">
                    <label class="col-form-label col-xs-3">Символьный код</label>
                    <input name="code" required="" type="text" class="form-control" value="<?=$forecaster_people ? $forecaster_people->code : ''?>">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Фото:</label>
                    <input class="form-control" type="file"  name="image" <?if(empty($forecaster_people->image)){?>required="" <?}?>/>
                    <?if(isset($forecaster_people->image)){?>
                        <img class="border-image" src="/upload/<?=$forecaster_people->image?>" width="100"/>
                    <?}?>
                </div>

                <div class="form-group ">
                    <label class="col-form-label col-xs-3">Описание</label>
                    <textarea rows="8" required="" class="form-control ckeditor" name="description"><?=$forecaster_people ? $forecaster_people->description : ''?></textarea>
                </div>

               
                <div class="form-group ">
                    <label class="col-form-label col-xs-3">Автивно</label>
                    <input
                        style="width:30px"
                        <?
                        if($forecaster_people){
                            if($forecaster_people->active == 1){?>checked="" <?}
                        }else {?>
                            checked=""
                        <?}
                    ?>

                        name="active" type="checkbox" class="form-control" value="1"/>
                </div>
                <div class="form-group ">
                    <a href="/admin/forecaster-people" class="btn btn-secondary">Закрыть</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>

        </form>
        </div>
    </div>
</div>

</div>
</div>




@endsection
