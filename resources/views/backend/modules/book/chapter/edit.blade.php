@extends('backend.layouts.dashboard')

@section('scripts')
    @parent
    @include('scripts.tinymce')
    {{--@include('scripts.trumbowyg')--}}
@stop

@section('styles')
    @parent
    {{--@include('styles.trumbowyg')--}}
@stop


@section('content')

    {!! Breadcrumbs::render('book_edit') !!}
    <div class="panel-body">


        {!! Form::model($chapter,['action'=>'Backend\ChaptersController@update','method' => 'PATCH', 'files'=>'true'], ['class'=>'form-horizontal']) !!}
        {!! Form::hidden('id',$chapter->id) !!}
        {!! Form::hidden('book_id',Request::get('book_id')) !!}
        <div class="form-group">
            {!! Form::label('title',trans('general.title')) !!}
            {!! Form::text('title', $chapter->title, ['class' => 'form-control','placeholder'=> trans('general.title')]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', trans('general.content'), ['class' => 'control-label']) !!}*
            {!! Form::textarea('body', $chapter->body, ['class' => 'form-control editor']) !!}
        </div>

        @include('backend.partials.buttons.form_btn_create')
        {!! Form::close() !!}

    </div>

@stop

