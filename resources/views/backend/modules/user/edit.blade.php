@extends('backend.layouts.dashboard')


@section('content')


    {!! Breadcrumbs::render('user_edit') !!}

    <div class="panel-body">

        {!! Form::model($user, ['action' => ['Backend\UsersController@update', $user->id], 'method' =>
        'PATCH','files'=>'true','class'=>'form-vertical']) !!}

        @if(Request::user()->isAuthor())
        <div class="form-group">
            {!! Form::label('email', trans('general.email')) !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', trans('general.password')) !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>
        @endif

        <div class="form-group">
            {!! Form::label('name', trans('general.name')) !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('phone', trans('general.phone')) !!}
            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('avatar', trans('general.avatar')) !!}
            {!! Form::file('avatar', null, ['class' => 'form-control']) !!}
        </div>
        @if(Request::user()->isAdmin())
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
        @endif

        @include('backend.partials.buttons.form_btn_update')

        {!! Form::close() !!}
    </div>

@stop