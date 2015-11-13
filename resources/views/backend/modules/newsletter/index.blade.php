@extends('backend.layouts.dashboard')

@section('scripts')
    @parent
    <script type="text/javascript">
        $(function () {
            $("#newsletter").DataTable();
        });
    </script>
@endsection


@section('content')
    {!! Breadcrumbs::render('newsletter') !!}
@section('titlebar')
    @can('create','newsletter_create')
    <a class="{{ Config::get('button.btn-create') }}"
       href="{{ action('Backend\NewsletterController@create') }}"><i
                class="fa fa-x1 fa-plus icon-material-indigo-200"></i></a>
    @endcan
@stop

<div class="panel-body">
    <table class="table table-hover table-stripped" id="newsletter">
        <thead>
        <tr class="well-material-blue-grey-100">
            <th>#</th>
            <th>{{ trans('general.name') }}</th>
            <th>{{ trans('general.email') }}</th>
            <th>{{ trans('general.edit') }}</th>
            <th>{{ trans('general.delete') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($subscribers as  $subscriber)
            <tr>
                <td>{{ $subscriber->id }}</td>
                <td>{{ $subscriber->name }}</td>
                <td>{{ $subscriber->email }}</td>
                <td width="80">
                    @can('edit',Auth::id())
                    <a class="{{ Config::get('button.btn-edit') }}"
                       title="{{ trans('buttons.edit') }}"
                       href="{{ action('Backend\RolesController@edit', $role->id) }}"><i
                                class="fa faw fa-edit"></i></a>
                    @endcan
                </td>

                <td width="80">
                    @can('checkAssignedPermission','newsletter_delete')
                    {!! Form::open(['action' => ['Backend\NewsletterController@destroy', $subscriber->id], 'method'
                    => 'DELETE']) !!}
                    <button type="submit" class="{{ Config::get('button.btn-delete') }}"
                            title="{{ trans('buttons.role_delete') }}">
                        <i class="fa fa=fw fa-times"></i></button>
                    {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{--    {!! $roles->render() !!}--}}

@stop