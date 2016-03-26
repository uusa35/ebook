@extends('backend.layouts.dashboard')

@section('scripts')
    @parent
    <script type="text/javascript">
        $(function () {
            $("#roles").DataTable();
        });
    </script>
@endsection


@section('content')
    {!! Breadcrumbs::render('roles') !!}
@section('titlebar')
    @can('authorizeAccess','role_create')
    <a href="{{ action('Backend\RolesController@create') }}" class="{{ Config::get('button.btn-create') }}"
       title="{{ trans('buttons.role_create') }}">
        <i class="fa fa-plus"></i></a>
    @endcan
@stop
<div class="panel-body">
    <table class="table table-hover table-stripped" id="roles">
        <thead>
        <tr class="well-material-blue-grey-100">
            <th>#</th>
            <th>{{ trans('general.display_name') }}</th>
            <th>{{ trans('general.name') }}</th>
            <th>{{ trans('general.permission') }}</th>
            <th>{{ trans('general.edit') }}</th>
            <th>{{ trans('general.delete') }}</th>
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
                        <span class="label small well-material-orange-600 "
                              style="line-height: 2.5; border-radius: 7px;">{{ $permission->name }}</span>
                    @endforeach
                </td>
                <td width="80">
                    <a class="{{ Config::get('button.btn-edit') }}"
                       title="{{ trans('buttons.edit') }}"
                       href="{{ action('Backend\RolesController@edit', $role->id) }}"><i
                                class="fa faw fa-edit"></i></a>
                </td>

                <td width="80">
                    {!! Form::open(['action' => ['Backend\RolesController@update', $role->id], 'method'
                    => 'DELETE']) !!}
                    <button type="submit" class="{{ Config::get('button.btn-delete') }}"
                            title="{{ trans('buttons.role_delete') }}">
                        <i class="fa fa=fw fa-times"></i></button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop