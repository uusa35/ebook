@extends('backend.layouts.dashboard')


@section('scripts')
    @parent
    <script type="text/javascript">
        $(function () {
            $("#permissions").DataTable();
        });
    </script>
@endsection

@section('content')
    {!! Breadcrumbs::render('permissions') !!}
@section('titlebar')
    @can('create','permission_create')
    <a class="{{ Config::get('button.btn-create') }}"
       href="{{ action('Backend\PermissionsController@create') }}"><i
                class="fa fa-x1 fa-plus icon-material-indigo-200"></i></a>
    @endcan
@stop

<div class="panel-body">
    <table class="table table-stripped table-hover" id="permissions">
        <thead>
        <tr class="well-material-blue-grey-100">
            <th>#</th>
            <th>{{ trans('general.display_name') }}</th>
            <th>{{ trans('general.name') }}</th>
            <th>{{ trans('general.level') }}</th>
            <th>{{ trans('general.edit') }}</th>
            <th>{{ trans('general.delete') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->display_name }}</td>
                <td>{{ $permission->name }}</td>
                <td> {!! ($permission->level === '1') ? "<span class='label label-info'>Module</span>" : "<span
                            class='label label-warning'>Permission</span>" !!}
                </td>

                <td width="80">
                    <a class="{{ Config::get('button.btn-edit') }}"
                       href="{{ action('Backend\PermissionsController@edit', $permission->id) }}"
                       title="{{ trans('buttons.permission_edit') }}">
                        <i class="fa faw fa-edit"></i>
                    </a>
                </td>


                <td width="80">
                    {!! Form::open(['action' => ['Backend\PermissionsController@update', $permission->id], 'method'
                    => 'DELETE']) !!}
                    <button type="submit" class="{{ Config::get('button.btn-delete') }}"
                            title="{{ trans('buttons.permission_delete') }}"><i class=" fa fa=fw fa-times
                        "></i></button>
                    {!! Form::close() !!}
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop