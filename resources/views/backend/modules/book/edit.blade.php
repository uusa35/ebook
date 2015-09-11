@extends('backend.layouts.dashboard')

@section('style')
    @parent
@stop

@section('scripts')
    @parent
    {{--@include('backend.partials.tinymce')--}}
@stop

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-6">
                    <h3>{{ trans('word.general.book-edit') }}</h3>
                </div>
                <div class="col-lg-6">
                    <p style="color:red;">(*) - {{ trans('word.general.all-started-required') }}</p>

                    <p style="color:red;">(*) - {{ trans('word.general.cover-instructions') }}</p>
                </div>
            </div>
        </div>
        <div class="panel-body">
            {!! Form::model($book,['action' => ['Backend\BooksController@update',$book->id], 'method' =>
            'PATCH','files'=>'true'], ['class'=>'form-horizontal']) !!}
            {!! Form::hidden('id',$book->id)!!}
            <div class="row">
                <div class="row page-header">
                    <div class="col-lg-2 col-md-2 col-lg-offset-4">
                        <img class="img-thumbnail img-responsive "
                             src="{{ asset('images/uploads/cover_ar/thumbnail/'.$book->cover_ar ) }}" alt="">
                    </div>
                    <div class="col-lg-2 col-md-2 ">
                        <img class="img-thumbnail img-responsive "
                             src="{{ asset('images/uploads/cover_en/thumbnail/'.$book->cover_en) }}" alt="">
                    </div>
                </div>
                <div class="form-group col-md-3 col-lg-3">
                    {!! Form::label('cover_ar', trans('word.general.cover_ar') , ['class' => 'control-label']) !!}*
                    {!! Form::file('cover_ar', null,['class' => 'form-control','placeholder'=>
                    trans('word.general.cover_ar')
                    ]) !!}
                </div>
                <div class="form-group col-md-3 col-lg-3">
                    {!! Form::label('cover_en', trans('word.general.cover_en') , ['class' => 'control-label']) !!}*
                    {!! Form::file('cover_en',null,['class' => 'form-control','placeholder'=>
                    trans('word.general.cover_en')
                    ]) !!}
                </div>
                <div class="form-group col-md-3 col-lg-3">
                    <div class="checkbox">
                        {{ trans('word.general.active') }}
                        <label>
                            {!! Form::checkbox('active[]', $book->active , (in_array($book->active,['1'],'true')) ? true : '') !!}
                        </label>
                    </div>

                </div>
            </div>
            <div class="form-group col-md-3 col-lg-3">
                {!! Form::label('title_en', 'Title In English', ['class' => 'control-label']) !!}*
                {!! Form::text('title_en', null, ['class' => 'form-control','placeholder'=>'Book Title in English']) !!}
            </div>

            <div class="form-group col-md-3 col-lg-3">
                {!! Form::label('title_ar', 'Title In Arabic', ['class' => 'control-label']) !!}*
                {!! Form::text('title_ar', null, ['class' => 'form-control','placeholder'=>'Book Title in Arabic']) !!}
            </div>

            <div class="form-group col-md-3 col-lg-3">

                {!! Form::label('field_category_id', trans('word.categories'), ['class' => 'control-label']) !!}*
                {!! Form::select('field_category_id', $fieldsCategories ,null, ['class' =>
                'form-control','style'=>'text-align:left
                !important;']) !!}
            </div>
            <div class="form-group col-md-3 col-lg-3">

                {!! Form::label('lang_category_id', trans('word.categories'), ['class' => 'control-label']) !!}*
                {!! Form::select('lang_category_id', $langsCategories ,null, ['class' =>
                'form-control','style'=>'text-align:left
                !important;']) !!}
            </div>
            <div class="row">
                <div class="form-group col-md-6 col-lg-6">
                    {!! Form::label('description_ar', trans('word.description-ar') , ['class' => 'control-label']) !!}*
                    {!! Form::textarea('description_ar', null, ['class' => 'form-control','placeholder'=>
                    trans('word.descrption-ar')]) !!}
                </div>
                <div class="form-group col-md-6 col-lg-6">
                    {!! Form::label('description_en', trans('word.description-en') , ['class' => 'control-label']) !!}*
                    {!! Form::textarea('description_en', null, ['class' => 'form-control','placeholder'=>
                    trans('word.descrption-en')]) !!}
                </div>
            </div>

            @include('backend.partials.buttons.form_btn_update')

            {!! Form::close() !!}
        </div>
    </div>

@stop