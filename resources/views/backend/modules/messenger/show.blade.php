@extends('backend.layouts.dashboard')

@section('content')
    {!! Breadcrumbs::render('message_show') !!}
    <div class="panel-body">

        <div class="col-md-12">
            <div class="panel">
                <h4 class="panel-heading">{!! $thread->subject !!}</h4>


                <div class="panel-body">
                    <div id="thread_{{$thread->id}}">
                        @foreach($thread->messages as $message)
                            @include('backend.modules.messenger.html-message', $message)
                        @endforeach
                    </div>

                    <hr/>
                    <h2>{{ trans('general.add_new_message') }}</h2>
                    <hr/>


                    {!! Form::open(['action' => ['Backend\MessagesController@update', $thread->id], 'method' => 'PUT']) !!}
                    <!-- Message Form Input -->
                    <div class="form-group">
                        {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                    </div>


                    @if($usersList->count() > 0)
                        <div class="form-group">
                            {!! Form::label('usersList',trans('general.users')) !!} :
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
                    <div class="form-group col-lg-3">
                        {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-material-blue-grey-400 form-control']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                </div>


        </div>
    </div>




@stop
