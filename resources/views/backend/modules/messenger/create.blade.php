@extends('backend.layouts.dashboard')

@section('content')
    {!! Breadcrumbs::render('message_create') !!}
    <div class="panel-body">
        <div class="col-lg-8 col-lg-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>{{ trans('general.create_message') }}</h1>
                </div>
                <div class="panel-body">


                    {!! Form::open(['action' => 'Backend\MessagesController@store']) !!}
                    <div class="col-md-12">
                        <!-- Subject Form Input -->
                        <div class="form-group">
                            {!! Form::label('subject', trans('general.title'), ['class' => 'control-label']) !!}
                            {!! Form::text('subject', $title, ['class' => 'form-control']) !!}
                        </div>


                        <div class="form-group ">
                            {!! Form::label('title', trans('general.subject'),['class' => 'control-label']) !!}
                            {!! Form::select('title',$subjectList, null,['class'=>'form-control']) !!}
                        </div>


                        <!-- Message Form Input -->
                        <div class="form-group">
                            {!! Form::label('message', trans('general.content'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                        </div>

                        @if($usersList->count() > 0)
                            <div class="form-group well-material-grey-300" style="padding: 10px;">
                                {!! Form::label('usersList',trans('general.users')) !!} :
                                {!! Form::select('usersList',$usersList,null,['multiple'=>'multiple','name'=>'recipients[]','class'=>'form-control','id'=>'users']) !!}
                            </div>
                            @endif

                                    <!-- Submit Form Input -->
                            <div class="form-group">
                                {!! Form::submit(trans('general.submit'), ['class' => 'btn btn-primary']) !!}
                            </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop
