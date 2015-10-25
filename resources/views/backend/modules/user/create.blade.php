@extends('backend.layouts.dashboard')

@section('content')

    {!! Breadcrumbs::render('user_create') !!}

    <div class="panel-body">

        {!! Form::open(['action' => 'Backend\UsersController@store']) !!}

        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name', trans('general.name')) !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('phone', trans('general.phone')) !!}
            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password_confirmation', 'Password confirmation') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="">Roles</label>

            <div class="row">
                @foreach($roles as $role)
                    <div class="col-lg-2">
                        <div class="checkbox">
                            {{ $role->display_name }}
                            <label>
                                {!! Form::checkbox('role[]', $role->id) !!}
                            </label>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-lg-1">
                    {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                </div>
                <div class="col-lg-1 col-lg-offset-1">
                    <a class="btn btn-danger" href="{{ URL::to('/backend') }}">cancel</a>
                </div>
            </div>

        </div>

        {!! Form::close() !!}
    </div>
@stop