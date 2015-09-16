@extends('backend.layouts.dashboard')

@section('content')
    <div class="panel-body">

        {!! Form::open(['action'=>'Backend\ChaptersController@store','method' => 'post', 'files'=>'true'], ['class'=>'form-horizontal']) !!}


        <div class="form-group">
            {!! Form::label('title',trans('word.general.title')) !!}
            {!! Form::text('title', null, ['class' => 'form-control','placeholder'=> trans('word.general.title')]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', trans('word.general.content'), ['class' => 'control-label']) !!}*
            {!! Form::textarea('body', null, ['class' => 'form-control editor']) !!}
        </div>

        @include('backend.partials.buttons.form_btn_create')

    </div>

@stop

@section('scripts')
    @parent
    @include('scripts.tinymce')
@stop

