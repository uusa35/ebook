@extends('backend.layouts.dashboard')

@section('content')
    {!! Breadcrumbs::render('condition_edit') !!}

    <div class="panel-body">

        {!! Form::open(['action'=>'Backend\UsersController@postEditConditions','method'=>'post'],['class'=>'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('title_ar',trans('word.title-ar')) !!}
            {!! Form::text('title_ar',$terms->title_ar,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('title_en',trans('word.title-en')) !!}
            {!!
            Form::text('title_en',$terms->title_en,['class'=>'form-control','placeholder'=>trans('word.title-en')])
            !!}
        </div>
        <div class="form-group">
            {!! Form::label('body_ar',trans('word.body-ar')) !!}
            {!!
            Form::textarea('body_ar',$terms->body_ar,['class'=>'form-control','placeholder'=>trans('word.body-ar')])
            !!}
        </div>
        <div class="form-group">
            {!! Form::label('body_en',trans('word.body-en')) !!}
            {!!
            Form::textarea('body_en',$terms->body_en,['class'=>'form-control','placeholder'=>trans('word.body-en')])
            !!}
        </div>

        @include('backend.partials.buttons.form_btn_update')

        {!! Form::close() !!}


    </div>

@stop