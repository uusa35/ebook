@extends('backend.layouts.one_col')

@section('content')
    <div class="row">

        <div class="col-lg-6 col-md-6 col-lg-offset-3">
            <div class="panel panel-default">

                <div class="panel-heading">
                    {{ trans('word.conditions') }}
                </div>
                <div class="panel-body">
                        {!! Form::open(['action'=>'Backend\UserController@postEditCondtions','method'=>'post'],['class'=>'form-horizontal']) !!}
                    <div class="form-group">
                        {!! Form::label('title_ar',trans('word.title-ar')) !!}
                        {!! Form::text('title_ar',$terms->title_ar,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('title_en',trans('word.title-en')) !!}
                        {!! Form::text('title_en',$terms->title_en,['class'=>'form-control','placeholder'=>trans('word.title-en')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('body_ar',trans('word.body-ar')) !!}
                        {!! Form::textarea('body_ar',$terms->body_ar,['class'=>'form-control','placeholder'=>trans('word.body-ar')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('body_en',trans('word.body-en')) !!}
                        {!! Form::textarea('body_en',$terms->body_en,['class'=>'form-control','placeholder'=>trans('word.body-en')]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit(trans('word.save'),['class'=>'btn btn-success form-control']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>

@stop