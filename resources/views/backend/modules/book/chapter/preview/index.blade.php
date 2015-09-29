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
    {!! Breadcrumbs::render('chapter_preview') !!}

@section('titlebar')
    @can('create')
    <a class="{{ Config::get('button.btn-create') }}"
       href="{{ action('Backend\PreviewsController@create',$chapterId) }}"
       title="{{ trans('general.user_create') }}">
        {!! Config::get('button.icon-create')!!}</a>
    @endcan
@stop

<div class="panel-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>{{ trans('general.chapter_id') }}</th>
            <th>{{ trans('general.author') }}</th>
            <th>{{ trans('general.previewer') }}</th>
            <th>{{ trans('general.total_pages') }}</th>
            <th>{{ trans('general.view') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($previews as $preview)
            <tr>
                <td>{{ $preview->chapter_id }}</td>
                <td>{{ $preview->author->name }}</td>
                <td>
                    @foreach($preview->users as $user)
                        {{ $user->name }}
                    @endforeach
                </td>
                <td>{{ $preview->total_pages }}</td>
                <td>
                    <a class="{!! Config::get('button.btn-view') !!}" title="{{ trans('general.view_pdf') }}"
                       href="{{ action('Backend\PreviewsController@show',[$preview->chapter_id,$preview->preview_start,$preview->preview_end]) }}">
                        {!! Config::get('button.icon-view') !!}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


</div>

@stop