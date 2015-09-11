@extends('backend.layouts.dashboard')

@section('content')
    <div class="panel-body">


        <div class="form-group">
            {!! Form::label('body', trans('word.general.content'), ['class' => 'control-label']) !!}*
            {!! Form::textarea('body', null, ['class' => 'form-control editor']) !!}
        </div>


    </div>

@stop

@section('scripts')
    @parent
    @include('scripts.tinymce')
@stop

