@extends('backend.layouts.dashboard')

@section('content')
    {!! Breadcrumbs::render('message_show') !!}
    <div class="panel-body">

        <div class="col-md-10">
            <h1>{!! $thread->subject !!}</h1>


            <div id="thread_{{$thread->id}}">
                @foreach($thread->messages as $message)
                    @include('backend.modules.messenger.html-message', $message)
                @endforeach
            </div>

            <h2>{{ trans('general.add_new_message') }}</h2>

            {!! Form::open(['action' => ['Backend\MessagesController@update', $thread->id], 'method' => 'PUT']) !!}
            <!-- Message Form Input -->
            <div class="form-group">
                {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
            </div>


            @if($usersList->count() > 0)
                <div class="form-group">
                    {!! Form::label('usersList',trans('word.users')) !!} :
                    {!!
                    Form::select('usersList',$usersList,null,['multiple'=>'multiple','name'=>'recipients[]','class'=>'form-control','id'=>'users'])
                    !!}
                </div>
            @endif
            {{--@foreach($users as $user)
                <div class="checkbox">
                    <span>
                        {{ ($user->name) }}
                    </span>
                    <label>
                        <input type="checkbox" name="recipients[]" value="{!! $user->id !!}">
                    </label>

                </div>
            @endforeach--}}

            <!-- Submit Form Input -->
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>




@stop
