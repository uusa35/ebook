@extends('backend.layouts.one_col')

@section('content')
    <div class="row">

        <div class="col-lg-6 col-md-6 col-lg-offset-3">
            <div class="panel panel-default">

                <div class="panel-heading">
                    {{ trans('general.conditions') }}
                </div>
                <div class="panel-body">
                        {!! Form::open(['action'=>'Backend\UserController@postEditCondtions','method'=>'post'],['class'=>'form-horizontal']) !!}
                    <div class="form-group">
                        {!! Form::label('title_ar',trans('general.title_ar')) !!}
                        {!! Form::text('title_ar',$terms->title_ar,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('title_en',trans('general.title_en')) !!}
                        {!! Form::text('title_en',$terms->title_en,['class'=>'form-control','placeholder'=>trans('general.title_en')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('body_ar',trans('general.body_ar')) !!}
                        {!! Form::textarea('body_ar',$terms->body_ar,['class'=>'form-control','placeholder'=>trans('general.body_ar')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('body_en',trans('general.body_en')) !!}
                        {!! Form::textarea('body_en',$terms->body_en,['class'=>'form-control','placeholder'=>trans('general.body_en')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit(trans('general.save'),['class'=>'btn btn-success form-control']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>

@stop