@extends('backend.layouts.dashboard')

@section('content')

    @section('titlebar')
        <div class="col-lg-1">
            <a class="{!! Config::get('button.btn-index') !!}" href="{{ action('Backend\LangCategories@index') }}">
                {!! Config::get('button.icon-index')!!}
            </a>
        </div>

        @endsection
    {!! Breadcrumbs::render('field_category_create') !!}

    <div class="panel-body">
        {!! Form::open(['action'=>'Backend\FieldCategoriesController@store'],['class'=>'form-horizontal']) !!}
        @include('backend.modules.category.form_create')
        {!! Form::close() !!}
    </div>

@stop