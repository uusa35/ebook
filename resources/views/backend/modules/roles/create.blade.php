@extends('backend.layouts.dashboard')

@section('content')

    {!! Breadcrumbs::render('role_create') !!}


    <div class="panel-body">

        {!! Form::open(['action' => 'Backend\RolesController@store']) !!}

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

                {!! Form::label('permissions', trans('word.general.permissions')) !!}

                @foreach($permissions as $permission)
                    <div class="col-lg-2">
                        <div class="checkbox">
                            {{ $permission->display_name }}
                            <label>
                                {!! Form::checkbox('perms[]', $permission->id) !!}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @include('backend.partials.buttons.form_btn_create')

        {!! Form::close() !!}
    </div>

@stop