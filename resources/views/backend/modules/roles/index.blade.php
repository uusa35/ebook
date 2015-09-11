@extends('backend.layouts.dashboard')

@section('content')
    {!! Breadcrumbs::render('roles') !!}
    @section('titlebar')
        <a href="{{ action('Backend\RolesController@create') }}" class="{{ Config::get('button.btn-create') }}"><i class="fa fa-plus"></i></a>
        @stop
<div class="panel-body">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('word.general.display_name') }}</th>
            <th>{{ trans('word.general.name') }}</th>
            <th>{{ trans('word.general.permission') }}</th>
            <th>{{ trans('word.general.edit') }}</th>
            <th>{{ trans('word.general.delete') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->display_name }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    @foreach($role->perms as $permission)
                        <span class="label label-info">{{ $permission->name }}</span>
                    @endforeach
                </td>
                <td width="80"><a class="{{ Config::get('button.btn-edit') }}" href="{{ action('Backend\RolesController@edit', $role->id) }}"><i class="fa faw fa-edit"></i></a></td>
                @if(Cache::get('Admin'))
                    <td width="80">{!! Form::open(['action' => ['Backend\RolesController@update', $role->id], 'method' => 'DELETE']) !!}
                        <button type="submit" class="{{ Config::get('button.btn-delete') }}"><i class="fa fa=fw fa-times"></i></button>
                        {!!  Form::close() !!}</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>

{{--    {!! $roles->render() !!}--}}

@stop