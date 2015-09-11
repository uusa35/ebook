@extends('backend.layouts.dashboard')


@section('scripts')
    @parent
    @include('backend.partials.tinymce')
    <script type="text/javascript">
        $('.free').on('change', function () {
            if(this.checked) {
                $('.price').attr('disabled','disabled');
            }
            else {
                $('.price').removeAttr('disabled','disabled');
            }
        });
    </script>
@stop


@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-lg-6">
                <h3>{{ trans('word.book-create') }}</h3>
            </div>
            <div class="col-lg-6">
                <p style="color:red;">(*) - {{ trans('word.fields-required') }}</p>
                <p style="color:red;">(*) - {{ trans('word.cover-instructions') }}</p>
            </div>
        </div>
    </div>
    <div class="panel-body">
        {!! Form::open(['action' => 'Backend\BooksController@store', 'method' => 'post','files'=>'true'], ['class'=>'form-horizontal']) !!}
        <div class="row">
            <div class="form-group col-lg-4 col-md-4 hidden">
                {!! Form::label('free', trans('word.free-book'))  !!}
                {!! Form::hidden('free', 0) !!}
                {!! Form::checkbox('free', 1, true,['class'=>'free']) !!} </br>
                {!! Form::label('type', trans('word.books'))!!}
                {!! Form::radio('type', 'book',true) !!}
                {!! Form::label('type', trans('word.poem'))!!}
                {!! Form::radio('type', 'poem', false) !!}
            </div>
            <div class="form-group col-md-2 col-lg-2 hidden">
                {!! Form::hidden('price',0) !!}
                {!! Form::label('price', trans('word.price') , ['class' => 'control-label']) !!}*
                {!! Form::text('price', 0, ['class' => 'price form-control','placeholder'=> trans('word.price-kd'),'disabled'=>'disabled']) !!}
            </div>
            <div class="form-group col-md-3 col-lg-3 {{ (App::getLocale('lang') === 'en') ? 'hidden' : '' }}">
                {!! Form::label('cover_ar', trans('word.cover_ar') , ['class' => 'control-label']) !!}*
                {!! Form::file('cover_ar', ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-md-3 col-lg-3 {{ (App::getLocale('lang') === 'ar') ? 'hidden' : '' }}">
                {!! Form::label('cover_en', trans('word.cover_en') , ['class' => 'control-label']) !!}*
                {!! Form::file('cover_en',['class' => 'form-control' ]) !!}
            </div>
        </div>
        <div class="form-group col-md-4 col-lg-4 {{ (App::getLocale('lang') === 'ar') ? 'hidden' : '' }}">
            {!! Form::label('title_en', trans('word.title_en'), ['class' => 'control-label']) !!}*
            {!! Form::text('title_en', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-md-4 col-lg-4 {{ (App::getLocale('lang') === 'en') ? 'hidden' : '' }}">
            {!! Form::label('title_ar', trans('word.title_ar'), ['class' => 'control-label']) !!}*
            {!! Form::text('title_ar', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-md-4 col-lg-4">

            {!! Form::label('field_category_id', trans('word.categories'), ['class' => 'control-label']) !!}*
            {!! Form::select('field_category_id', $fields ,null, ['class' => 'form-control','style'=>'text-align:left !important;']) !!}
        </div>
        <div class="form-group col-md-4 col-lg-4">

            {!! Form::label('lang_category_id', trans('word.categories'), ['class' => 'control-label']) !!}*
            {!! Form::select('lang_category_id', $langs ,null, ['class' => 'form-control','style'=>'text-align:left !important;']) !!}
        </div>
        <div class="row">
            <div class="form-group col-md-12 col-lg-12 {{ (App::getLocale('lang') === 'en') ? 'hidden' : '' }}">
                {!! Form::label('description_ar',  trans('word.description-ar') , ['class' => 'control-label']) !!}*
                {!! Form::textarea('description_ar', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-md-12 col-lg-12 {{ (App::getLocale('lang') === 'ar') ? 'hidden' : '' }}">
                {!! Form::label('description_en',  trans('word.description-en') , ['class' => 'control-label']) !!}*
                {!! Form::textarea('description_en', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('body', trans('word.content'), ['class' => 'control-label']) !!}*
            {!! Form::textarea('body', null, ['class' => 'form-control editor']) !!}
        </div>

        <div class="form-group">
            <div class="col-lg-6">
                {!! Form::submit(trans('word.save'), ['class' => 'btn btn-primary form-control']) !!}
            </div>
            <div class="col-lg-6">
                <a class="btn btn-danger form-control" href="{{ URL::previous() }}">{{ trans('word.cancel') }}</a>
            </div>
        </div>
    </div>
</div>


    {!! Form::close() !!}
@stop
