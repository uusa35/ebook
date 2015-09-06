@extends('backend.layouts.dashboard')

@section('content')

    <div class="panel-heading">
        {!! Form::open(['action' => 'Backend\PermissionsController@store']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('display_name', 'Display name') !!}
            {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::text('description', null, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            <div class="row">
                <div class="col-lg-1">
                    {!! Form::submit(trans('word.general.submit'), ['class' => 'btn btn-primary']) !!}
                </div>
                <div class="col-lg-1 col-lg-offset-1">
                    <a class="btn btn-danger" href="{{ URL::to('/backend') }}">{{ trans('word.general.cancel') }}</a>
                </div>
            </div>

        </div>

        {!! Form::close() !!}
    </div>

@stop