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
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>{{ trans('word.name_en') }}</th>
            <th>{{ trans('word.name_ar') }}</th>
            <th>{{ trans('word.email') }}</th>
            <th>{{ trans('word.role') }}</th>
            <th>{{ trans('word.edit') }}</th>
            <th>{{ trans('word.activation') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>

                <td>{{ $user->id }}</td>
                <td>{{ $user->name_en }}</td>
                <td>{{ $user->name_ar }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach($user->roles as $role)
                        <span class="label label-info">{{ $role->name }}</span>
                    @endforeach
                </td>


                <td width="50"><a class="{{ Config::get('button.btn-edit') }}"
                                  href="{{ action('Backend\UsersController@edit', $user->id) }}"><i
                                class="fa fa-xs fa-edit"></i></a>
                </td>
                <td width="50">
                    {!! Form::open(['action' => ['Backend\UsersController@postChangeActiveStatus', $user->id,$user->active], 'method' => 'post']) !!}

                    <button type="submit" class=" {{ Config::get('button.btn-active') }} {{ ($user->active) ? 'btn-material-green' : 'btn-material-red-200' }}"><i
                                class="fa fa-xs fa-check"></i></button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


</div>

@stop