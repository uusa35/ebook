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
    @can('create')
    <a class="{{ Config::get('button.btn-create') }}" href="{{ action('Backend\UsersController@create') }}"
       title="{{ trans('general.user_create') }}">
        {!! Config::get('button.icon-create')!!}</a>
    @endcan
@stop

<div class="panel-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>{{ trans('word.general.name_en') }}</th>
            <th>{{ trans('word.general.phone') }}</th>
            <th>{{ trans('word.general.email') }}</th>
            <th>{{ trans('word.general.role') }}</th>
            <th>{{ trans('word.general.edit') }}</th>
            <th>{{ trans('word.general.activation') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>

                <td>{{ $user->id }}</td>
                <td>{{ $user->name_en }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->roles as $role)
                        <span class="label label-info">{{ $role->name }}</span>
                    @endforeach
                </td>


                <td width="50">
                    @can('edit')
                    <a class="{{ Config::get('button.btn-edit') }}"
                       title="{{ trans('word.general.edit') }}"
                       href="{{ action('Backend\UsersController@edit', $user->id) }}"><i
                                class="fa fa-xs fa-edit"></i></a>
                    @endcan
                </td>
                <td width="50">
                    @can('change')
                    {!! Form::open(['action' => ['Backend\UsersController@postChangeActiveStatus',
                    $user->id,$user->active], 'method' => 'post']) !!}

                    <button type="submit"
                            title="{{ ($user->active) ? trans('word.general.not_active') : trans('word.general.active') }}"
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