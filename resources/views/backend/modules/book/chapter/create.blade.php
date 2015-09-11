@extends('backend.layouts.dashboard')

@section('content')
    <div class="panel-body">

        <div class="form-group">
            {!! Form::label('body', trans('word.content'), ['class' => 'control-label']) !!}*
            {!! Form::textarea('body', null, ['class' => 'form-control editor']) !!}
        </div>


    </div>

@endsection

@section('scripts')
    @parent
    @include('styles.tinymce')
@endsection