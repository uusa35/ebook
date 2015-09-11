@extends('backend.layouts.dashboard')

@section('content')
    <div class="col-lg-6 col-lg-offset-3">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>{{ trans('word.create-message') }}</h1>
            </div>
            <div class="panel-body">


                {!! Form::open(['route' => 'messages.store']) !!}
                <div class="col-md-12">
                    <!-- Subject Form Input -->
                    <div class="form-group">
                        {!! Form::label('subject', trans('word.subject'), ['class' => 'control-label']) !!}
                        {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Message Form Input -->
                    <div class="form-group">
                        {!! Form::label('message', trans('word.content'), ['class' => 'control-label']) !!}
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

                                <!-- Submit Form Input -->
                        <div class="form-group">
                            {!! Form::submit(trans('word.submit'), ['class' => 'btn btn-primary form-control']) !!}
                        </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
