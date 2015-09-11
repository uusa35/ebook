@extends('backend.layouts.dashboard')

@section('content')

    <div class="col-lg-6 col-lg-offset-3">
        @if (Session::has('error_message'))
            <div class="alert alert-danger" role="alert">
                {!! Session::get('error_message') !!}
            </div>
        @endif
        @if($threads->count() > 0)

            @foreach($threads as $thread)
                <div class="panel {{ ($thread->isUnread($currentUserId) ? 'panel-info' : 'panel-default')}}">
                    <div class="panel-heading">

                        <h4 class="">{!! link_to('app/messages/' . $thread->id, $thread->subject) !!}</h4>

                    </div>

                    <div class="panel-body">
                        <p id="thread_list_{{$thread->id}}_text">{!! $thread->latestMessage->body !!}</p>

                        <p>
                            <small><strong>Participants:</strong> {!! $thread->participantsString(Auth::id(),
                                ['name_'.App::getLocale('lang')])
                                !!}
                            </small>
                        </p>
                    </div>
                </div>
            @endforeach

            {!! $threads->render() !!}
        @else
            <p>Sorry, no threads.</p>

        @endif

    </div>
@stop
