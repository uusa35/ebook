@extends('backend.layouts.dashboard')

@section('content')
    {!! Breadcrumbs::render('lang_category_create') !!}
    <div class="panel-body">
        {!! Form::open(['action'=>'Backend\LangCategoriesController@store'],['class'=>'form-horizontal']) !!}
            @include('backend.modules.category.form_create')
        {!! Form::close() !!}
    </div>

@stop