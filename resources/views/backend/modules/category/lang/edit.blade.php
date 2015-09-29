@extends('backend.layouts.dashboard')

@section('content')
@section('titlebar')
    <div class="col-lg-1">
        <a class="{!! Config::get('button.btn-index') !!}" href="{{ action('Backend\LangCategoriesController@index') }}">
            {!! Config::get('button.icon-index')!!}
        </a>
    </div>

@endsection

{!! Breadcrumbs::render('lang_category_create') !!}
<div class="panel-body">
    {!! Form::model($category,['action'=>['Backend\LangCategoriesController@update',$category->id],'method'=>'put'],['class'=>'form-horizontal']) !!}
    @include('backend.modules.category.form_edit')
    {!! Form::close() !!}
</div>

@stop