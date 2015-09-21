@extends('backend.layouts.dashboard')

@section('content')

    <div class="panel-body">
        {!! Form::model($permission, ['action' => ['Backend\PermissionsController@update', $permission->id], 'method' => 'PATCH']) !!}

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
            {!! Form::select('level', ['1'=>'1','2'=>'2'],$permission->level, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::text('description', null, ['class' => 'form-control']) !!}
        </div>

        @include('backend.partials.buttons.form_btn_update')

        {!! Form::close() !!}
    </div>

@stop