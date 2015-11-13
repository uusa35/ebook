@extends('backend.layouts.dashboard')



@section('scripts')
    @parent
    <script type="text/javascript">
        $(function () {
            $("#example1").DataTable();
        });
    </script>
@endsection

@section('content')
    {!! Breadcrumbs::render('users') !!}
@section('titlebar')
    @can('create','user_create')
    <a class="{{ Config::get('button.btn-create') }}" href="{{ action('Backend\UsersController@create') }}"
       title="{{ trans('general.user_create') }}">
        {!! Config::get('button.icon-create')!!}</a>
    @endcan
@stop

<div class="panel-body">
    <table id="example1" class="table table-striped table-hover">
        <thead>
        <tr class="well-material-blue-grey-100">
            <th>id</th>
            <th>{{ trans('general.name') }}</th>
            <th>{{ trans('general.phone') }}</th>
            <th>{{ trans('general.email') }}</th>
            <th>{{ trans('general.role') }}</th>
            <th>{{ trans('general.edit') }}</th>
            <th>{{ trans('general.activation') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>

                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->roles as $role)
                        <span class="label label-info">{{ $role->name }}</span>
                    @endforeach
                </td>


                <td width="50">
                    @can('checkAssignedPermission','user_edit')
                    <a class="{{ Config::get('button.btn-edit') }}"
                       title="{{ trans('general.edit') }}"
                       href="{{ action('Backend\UsersController@edit', $user->id) }}"><i
                                class="fa fa-xs fa-edit"></i></a>
                    @endcan
                </td>
                <td width="50">
                    @can('checkAssignedPermission','user_change')
                    {!! Form::open(['action' => ['Backend\UsersController@postChangeActiveStatus',
                    $user->id,$user->active], 'method' => 'post']) !!}

                    <button type="submit"
                            title="{{ ($user->active) ? trans('general.not_active') : trans('general.active') }}"
                            class=" {{ ($user->active) ? Config::get('button.btn-active')  : Config::get('button.btn-not-active') }}">
                        <i class="fa fa-xs fa-check"></i></button>
                    {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


</div>

@stop