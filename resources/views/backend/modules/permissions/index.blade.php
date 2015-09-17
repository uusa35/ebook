@extends('backend.layouts.dashboard')

@section('content')
    {!! Breadcrumbs::render('permissions') !!}
    @section('titlebar')
            <a class="{{ Config::get('button.btn-create') }}"
               href="{{ action('Backend\PermissionsController@create') }}"><i
                        class="fa fa-x1 fa-plus icon-material-indigo-200"></i></a>
    @stop

<div class="panel-body">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('word.general.display_name') }}</th>
            <th>{{ trans('word.general.name') }}</th>
            <th>{{ trans('word.general.level') }}</th>
            <th>{{ trans('word.general.edit') }}</th>
            <th>{{ trans('word.general.delete') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->display_name }}</td>
                <td>{{ $permission->name }}</td>
                <td> {!! ($permission->level === '1') ? "<span class='label label-info'>Module</span>" : "<span class='label label-warning'>Permission</span>" !!}</td>

                @if(Cache::get('Permission.permission_edit'))
                <td width="80"><a class="{{ Config::get('button.btn-edit') }}" href="{{ action('Backend\PermissionsController@edit', $permission->id) }}"><i class="fa faw fa-edit"></i></a></td>
                @endif
                @if(Cache::get('Permission.permission_delete'))
                    <td width="80">{!! Form::open(['action' => ['Backend\PermissionsController@update', $permission->id], 'method' => 'DELETE']) !!}
                        <button type="submit" class="{{ Config::get('button.btn-delete') }}"><i class="fa fa=fw fa-times"></i></button>
                        {!!  Form::close() !!}</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

    {{--{!! $permissions->render() !!}--}}
</div>
@stop