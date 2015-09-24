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
    {!! Breadcrumbs::render('books') !!}
    <div class="panel-body">

        {!! Form::open(['action'=>'Backend\ChaptersController@store','method' => 'post', 'files'=>'true'], ['class'=>'form-horizontal']) !!}
        {!! Form::hidden('book_id',$bookId) !!}
        <div class="form-group">
            {!! Form::label('title',trans('general.title')) !!}
            {!! Form::text('title', null, ['class' => 'form-control','placeholder'=> trans('general.title')]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', trans('general.content'), ['class' => 'control-label']) !!}*
            {!! Form::textarea('body', null, ['class' => 'form-control editor']) !!}
        </div>

        @include('backend.partials.buttons.form_btn_create')
        {!! Form::close() !!}

    </div>

@stop

