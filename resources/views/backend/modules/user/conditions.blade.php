@extends('backend.layouts.dashboard')

@section('scripts')
    @parent
    @include('scripts.tinymce')
    {{--@include('scripts.trumbowyg')--}}
@stop

@section('content')
    {!! Breadcrumbs::render('condition_edit') !!}

    <div class="panel-body">

        {!! Form::open(['action'=>'Backend\UsersController@postEditConditions','method'=>'post'],['class'=>'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('title_ar',trans('general.title_ar')) !!}
            {!! Form::text('title_ar',$terms->title_ar,['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('title_en',trans('general.title_en')) !!}
            {!!
            Form::text('title_en',$terms->title_en,['class'=>'form-control','placeholder'=>trans('general.title_en')])
            !!}
        </div>
        <div class="form-group">
            {!! Form::label('body_ar',trans('general.body_ar')) !!}
            {!!
            Form::textarea('body_ar',$terms->body_ar,['class'=>'form-control editor','placeholder'=>trans('general.body_ar')])
            !!}
        </div>
        <div class="form-group">
            {!! Form::label('body_en',trans('general.body_en')) !!}
            {!!
            Form::textarea('body_en',$terms->body_en,['class'=>'form-control editor','placeholder'=>trans('general.body_en')])
            !!}
        </div>

        @include('backend.partials.buttons.form_btn_update')

        {!! Form::close() !!}


    </div>

@stop