@extends('backend.layouts.dashboard')

@section('content')
<div class="row">

<div class="col-lg-6 col-md-6 col-lg-offset-3">
    <div class="panel panel-default">

        <div class="panel-heading">
            {{ trans('word.edit-category') }}
        </div>
        <div class="panel-body">
            @if(in_array('field',Request::segments()))
            {!! Form::model($category,['action'=>['Backend\FieldCategoryController@update',$category->id],'method'=>'put'],['class'=>'form-horizontal']) !!}
            @else
                {!! Form::model($category,['action'=>['Backend\LangCategoryController@update',$category->id],'method'=>'put'],['class'=>'form-horizontal']) !!}
            @endif
            <div class="form-group">
                {!! Form::label('name_ar',trans('word.category-ar')) !!}
                {!! Form::text('name_ar',null,['class'=>'form-control','placeholder'=>trans('word.category-ar')]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name_en',trans('word.category-en')) !!}
                {!! Form::text('name_en',null,['class'=>'form-control','placeholder'=>trans('word.category-en')]) !!}
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