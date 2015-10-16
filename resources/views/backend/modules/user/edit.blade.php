@extends('backend.layouts.dashboard')


@section('content')


    <div class="panel-body">

        {!! Form::model($user, ['action' => ['Backend\UsersController@update', $user->id], 'method' =>
        'PATCH','files'=>'true','class'=>'form-vertical']) !!}

        <div class="form-group">
            {!! Form::label('email', trans('general.email')) !!}
            {!! Form::text('email', null, ['class' => 'form-control','disabled'=>'disabled']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', trans('general.password')) !!}
            {!! Form::password('password', ['class' => 'form-control','disabled'=> 'disabled']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('name_en', trans('general.name_en')) !!}
            {!! Form::text('name_en', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('phone', trans('general.phone')) !!}
            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('avatar', trans('general.avatar')) !!}
            {!! Form::file('avatar', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="">Roles</label>

            <div class="row">
                @foreach($roles as $role)
                    <div class="col-lg-2">
                        <div class="checkbox">
                            {{ $role->display_name }}
                            <label>
                                {!! Form::checkbox('role[]', $role->id,
                                (in_array($role->name,$userListRoleIds->toArray(),'true')) ? true : '') !!}
                            </label>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>

        @include('backend.partials.buttons.form_btn_update')

        {!! Form::close() !!}
    </div>

@stop