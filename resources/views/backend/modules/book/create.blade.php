@extends('backend.layouts.dashboard')

@section('content')

    {!! Breadcrumbs::render('book_create') !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-6">
                    <h3>{{ trans('word.general.book_edit') }}</h3>
                </div>
                <div class="col-lg-6">
                    <p style="color:red;">(*) - {{ trans('word.general.all_started_required') }}</p>

                    <p style="color:red;">(*) - {{ trans('word.general.cover_instructions') }}</p>
                </div>
            </div>
        </div>
        <div class="panel-body">
            {!! Form::open(['action' => ['Backend\BooksController@store'], 'method' => 'post','files'=>'true'], ['class'=>'form-horizontal']) !!}
            <div class="row">

                <div class="form-group col-md-3 col-lg-3">
                    {!! Form::hidden('user_id', Auth::id()) !!}
                    {!! Form::label('cover', trans('word.general.cover_ar') , ['class' => 'control-label']) !!}*
                    {!! Form::file('cover', null,['class' => 'form-control','placeholder'=>
                    trans('word.general.cover')
                    ]) !!}
                </div>
                {{--<div class="form-group col-md-3 col-lg-3">
                    {!! Form::label('cover_en', trans('word.general.cover_en') , ['class' => 'control-label']) !!}*
                    {!! Form::file('cover_en',null,['class' => 'form-control','placeholder'=>
                    trans('word.general.cover_en')
                    ]) !!}
                </div>--}}
                <div class="form-group col-md-3 col-lg-3">
                    <div class="checkbox">
                        {{ trans('word.general.active') }}
                        <label>
                            {!! Form::checkbox('active',1,'checked') !!}
                        </label>
                    </div>

                </div>
            </div>
            <div class="form-group col-md-3 col-lg-3">
                {!! Form::label('title', trans('word.general.title'), ['class' => 'control-label']) !!}*
                {!! Form::text('title', null,['class' => 'form-control','placeholder'=> trans('word.general.title')]) !!}
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
                    {!! Form::label('description', trans('word.general.description') , ['class' => 'control-label']) !!}*
                    {!! Form::textarea('description', null, ['class' => 'form-control','placeholder'=>
                    trans('word.general.description')]) !!}
                </div>
            </div>

            @include('backend.partials.buttons.form_btn_create')

            {!! Form::close() !!}
        </div>
    </div>

@stop