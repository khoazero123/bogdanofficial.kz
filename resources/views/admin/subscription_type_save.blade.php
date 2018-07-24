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
                    <input name="data[title]" required="" type="text" class="form-control" value="<?=$subscription_type ? $subscription_type->title : ''?>">
                </div>
                <div class="form-group ">
                    <label class="col-form-label col-xs-3">Количество дней</label>
                    <input name="data[day]" required="" type="number" class="form-control" value="<?=$subscription_type ? $subscription_type->day : ''?>">
                </div>
                <div class="form-group ">
                    <label class="col-form-label col-xs-3">Цена</label>
                    <input name="data[price]" required="" type="number" class="form-control" value="<?=$subscription_type ? $subscription_type->price : ''?>">
                </div>



                <div class="form-group ">
                    <label class="col-form-label col-xs-3">Автивно</label>
                    <input
                        style="width:30px"
                        <?
                        if($subscription_type){
                            if($subscription_type->active == 1){?>checked="" <?}
                        }else {?>
                            checked=""
                        <?}
                    ?>
                        name="data[active]" type="checkbox" class="form-control" value="1"/>
                </div>
                <div class="form-group ">
                    <a href="/admin/subscription-type" class="btn btn-secondary">Закрыть</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>

        </form>
        </div>
    </div>
</div>

</div>
</div>




@endsection
