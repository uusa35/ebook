@extends('backend.layouts.dashboard')

@section('content')

    <div class="panel-body">

        {!! Breadcrumbs::render('role_edit') !!}

        {!! Form::model($role, ['action' => ['Backend\RolesController@update', $role->id], 'method' => 'PATCH']) !!}

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

        {{--<div class="form-group">
            {!! Form::label('level', 'Level') !!}
            {!! Form::text('level', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
            {!! Form::hidden('level', $role->level) !!}
        </div>--}}

        <div class="form-group">

            {!! Form::label('permissions', trans('word.general.permissions')) !!}
            <div class="row">

                @foreach($permissions as $permission)
                    <div class="col-lg-3">
                        <div class="col-lg-2">
                            <div class="checkbox">
                                <label>
                                    {!! Form::checkbox('perms[]', $permission->id,
                                    (in_array($permission->name,$rolePerms->toArray(),true) ? true : '' ))
                                    !!}
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-10 well-material-grey-100">
                            {{ $permission->display_name }}
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        @include('backend.partials.buttons.form_btn_update')

        {!! Form::close() !!}
    </div>


@stop