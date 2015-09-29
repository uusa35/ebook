@extends('backend.layouts.dashboard')

@section('content')
    {!! Breadcrumbs::render('field_category_edit') !!}
    <div class="panel-body">
        {!! Form::model($category,['action'=>['Backend\FieldCategoriesController@update',$category->id],'method'=>'put'],['class'=>'form-horizontal']) !!}
        @include('backend.modules.category.form_create')
        {!! Form::close() !!}
    </div>

@stop


