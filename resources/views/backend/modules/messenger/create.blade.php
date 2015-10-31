@extends('backend.layouts.dashboard')

@section('content')
    {!! Breadcrumbs::render('message_create') !!}
    <div class="panel-body">
        <div class="col-lg-8 col-lg-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>{{ trans('word.create-message') }}</h1>
                </div>
                <div class="panel-body">


                    {!! Form::open(['action' => 'Backend\MessagesController@store']) !!}
                    <div class="col-md-12">
                        <!-- Subject Form Input -->
                        <div class="form-group">
                            {!! Form::label('subject', trans('word.subject'), ['class' => 'control-label']) !!}
                            @if(Session::has('book_id'))
                                {!! Form::text('subject', null, ['class' => 'form-control','placeholder' =>
                                trans('messages.report_abuse').Session::get('book_id')]) !!}
                            @else
                                {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                            @endif
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
    </div>

@stop
