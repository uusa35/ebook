@extends('backend.layouts.dashboard')


@section('scripts')
    @parent
    <script type="text/javascript">
        $(function () {
            $("#messages").DataTable();
        });
    </script>
@endsection

@section('content')
    {!! Breadcrumbs::render('messages') !!}

@section('titlebar')
    @can('create')
    <a class="{{ Config::get('button.btn-create') }}" href="{{ action('Backend\MessagesController@create') }}"
       title="{{ trans('general.message_create') }}">
        {!! Config::get('button.icon-create')!!}
    </a>
    @endcan
@stop
<div class="panel-body">

    @if($threads->count() > 0)

        <table class="table" id="messages" style="color:#000000;">
            <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('general.subject') }}</th>
                <th>{{ trans('general.body') }}</th>
                <th>{{ trans('general.participants') }}</th>
                <th>{{ trans('word.general.delete') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($threads as $thread)
                <tr class="{{ ($thread->isUnread($currentUserId) ? 'alert-info' : 'alert-default')}}">
                    <td>
                        {!! link_to('backend/messages/' . $thread->id, $thread->id) !!}
                    </td>
                    <td class="">
                        {!! link_to('backend/messages/' . $thread->id, $thread->subject) !!}
                    </td>
                    <td>
                        {!! link_to('backend/messages/' . $thread->id,
                        \Illuminate\Support\Str::limit($thread->latestMessage->body,30,'..more')) !!}
                    </td>
                    <td style="color: #000011;">
                        <small>
                            {!! $thread->participantsString(Auth::id(), ['name_'.App::getLocale('lang')])!!}
                        </small>
                    </td>
                    <td>

                    </td>
                </tr>
            @endforeach
        </table>


        {!! $threads->render() !!}
    @else
        <p>Sorry, no threads.</p>

    @endif


</div>
@stop
