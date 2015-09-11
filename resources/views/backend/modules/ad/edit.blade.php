@extends('backend.layouts.dashboard')

@section('content')
    <div class="row">

        <div class="col-lg-6 col-md-6 col-lg-offset-3">
            <div class="panel panel-default">

                <div class="panel-heading">
                    {{ trans('word.edit').trans('word.ads') }}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-4">
                            <img class="img-responsive thumbnail" src="{{ $ad->url }}" alt=""/>
                        </div>
                    </div>
                    {!! Form::open(['action'=>['Backend\AdController@update',$id],'method'=>'put','files'=>'true'],['class'=>'form-horizontal']) !!}
                    {!! Form::hidden('id',$id) !!}
                    <div class="form-group">
                        {!! Form::label('name_ar',trans('word.category-ar')) !!}
                        {!! Form::file('url',['class'=>'form-control','placeholder'=>trans('word.category-ar')]) !!}
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