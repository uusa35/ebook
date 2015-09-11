@extends('backend.layouts.dashboard')

@section('content')
    <div class="row">

        <div class="col-lg-6 col-md-6 col-lg-offset-3">
            <div class="panel panel-default">

                <div class="panel-heading">
                    {{ trans('word.create-category') }}
                </div>
                <div class="panel-body">
                    @if(in_array('field',Request::segments()))
                        {!! Form::open(['action'=>'Backend\FieldCategoryController@store'],['class'=>'form-horizontal']) !!}
                    @else
                        {!! Form::open(['action'=>'Backend\LangCategoryController@store'],['class'=>'form-horizontal']) !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('name_ar',trans('word.category-ar')) !!}
                        {!!
                        Form::text('name_ar',null,['class'=>'form-control','placeholder'=>trans('word.category-ar')])
                        !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('name_en',trans('word.category-en')) !!}
                        {!!
                        Form::text('name_en',null,['class'=>'form-control','placeholder'=>trans('word.category-en')])
                        !!}
                    </div>
                    <div class="form-group col-lg-6">
                        {!! Form::submit(trans('word.save'),['class'=>'btn btn-success form-control']) !!}
                    </div>
                    <div class="form-group col-lg-6">
                        <a class="btn btn-danger col-lg-12" href="{{ URL::previous() }}">{{trans('word.cancel')}}</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>

@stop