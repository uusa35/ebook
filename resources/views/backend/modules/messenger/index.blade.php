@extends('backend.layouts.dashboard')


@section('scripts')
    @parent
    <script type="text/javascript">
        $(function () {
            $("#messages").DataTable({
                "order": [[0, "asc"]]
            });
        });
    </script>
@endsection

@section('content')
    {!! Breadcrumbs::render('messages') !!}

@section('titlebar')
    @can('create','message_create')
    <a class="{{ Config::get('button.btn-create') }}" href="{{ action('Backend\MessagesController@create') }}"
       title="{{ trans('general.message_create') }}">
        {!! Config::get('button.icon-create')!!}
    </a>
    @endcan
@stop
<div class="panel-body">
    <table class="table table-stripped table-hover" id="messages">
        <thead>
        <tr class="well-material-blue-grey-100">
            <th>#</th>
            <th>{{ trans('general.subject') }}</th>
            <th>{{ trans('general.body') }}</th>
            <th>{{ trans('general.participants') }}</th>
            <th>{{ trans('general.delete') }}</th>
            <th>{{ trans('general.created_at') }}</th>
        </tr>
        </thead>
        <tbody>

        @foreach($threads as $thread)
            <tr class="{{ ($thread->isUnread($currentUserId) ? 'btn-material-red-100' : '')}}">
                <td>
                    {!! link_to('backend/messages/' . $thread->id, $thread->id) !!}
                </td>
                <td class="">
                    {!! link_to('backend/messages/' . $thread->id, $thread->subject) !!}
                </td>
                <td>
                    {{--{!! link_to('backend/messages/' . $thread->id,
                    \Illuminate\Support\Str::limit($thread->latestMessage->body,30,'..more')) !!}--}}
                    {!! link_to_action('Backend\MessagesController@show',\Illuminate\Support\Str::words($thread->messages->first()->body,3),[$thread->id])
                    !!}
                </td>
                <td style="color: #000011;">
                    @foreach($thread->participants as $participant)
                        <small>
                            {{--{!! $thread->participantsString(Auth::id(), ['name'])!!}--}}
                            {{ $participant->user->name }},
                        </small>
                    @endforeach
                </td>
                <td>
                    <a class="{{ Config::get('button.btn-delete') }}" href="{{ action('Backend\MessagesController@cancel', $thread->id) }}">
                        {!! Config::get('button.icon-delete') !!}
                    </a>
                </td>
                <td>
                    {{ $thread->created_at->format('d-M-Y') }}

                </td>
            </tr>
        @endforeach
    </table>
</div>
@stop
