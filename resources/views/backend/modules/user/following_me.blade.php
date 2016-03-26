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
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><a href="{{ action('UserController@show',$user->id) }}"> {{ $user->name }}</a></td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->roles as $role)
                        <span class="label label-info">{{ $role->name }}</span>
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


</div>

@stop