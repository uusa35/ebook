@extends('backend.layouts.dashboard')

@section('content')

    {!! Breadcrumbs::render('permission_create') !!}

    <div class="panel-body">
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
            {!! Form::label('level', 'level') !!}
            {!! Form::select('level', ['1'=>'1','2'=>'2'], ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::text('description', null, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group">
            <div class="row">
                <div class="col-lg-1">
                    {!! Form::submit(trans('general.submit'), ['class' => 'btn btn-primary']) !!}
                </div>
                <div class="col-lg-1 col-lg-offset-1">
                    <a class="btn btn-danger" href="{{ URL::previous() }}">{{ trans('general.cancel') }}</a>
                </div>
            </div>

        </div>

        {!! Form::close() !!}
    </div>

@stop