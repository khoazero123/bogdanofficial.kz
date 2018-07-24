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
                    <input name="data[title]" required="" type="text" class="form-control" value="<?=$faq ? $faq->title : ''?>">
                </div>
                <div class="form-group ">
                    <label class="col-form-label col-xs-3">Сортировка</label>
                    <input name="data[sort]" required="" type="number" class="form-control" value="<?=$faq ? $faq->sort : ''?>">
                </div>
                <div class="form-group ">
                    <label class="col-form-label col-xs-3">Текст</label>
                    <textarea rows="8" class="form-control ckeditor " name="data[text]"><?=$faq ? $faq->text : ''?></textarea>
                </div>

                <div class="form-group ">
                    <label class="col-form-label col-xs-3">Автивно</label>
                    <input
                        style="width:30px"
                        <?
                        if($faq){
                            if($faq->active == 1){?>checked="" <?}
                        }else {?>
                            checked=""
                        <?}
                    ?>

                        name="data[active]" type="checkbox" class="form-control" value="1"/>
                </div>
                <div class="form-group ">
                    <a href="/admin/faq" class="btn btn-secondary">Закрыть</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>

        </form>
        </div>
    </div>
</div>

</div>
</div>




@endsection
