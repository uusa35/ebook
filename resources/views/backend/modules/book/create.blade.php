@extends('backend.layouts.dashboard')

@section('content')

    {!! Breadcrumbs::render('book_create') !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-6">
                    <h3>{{ trans('general.book_create') }}</h3>
                </div>
                <div class="col-lg-6">
                    <p style="color:red;">(*) - {{ trans('messages.fields_required') }}</p>

                    <p style="color:red;">(*) - {{ trans('messages.cover_instructions') }}</p>
                </div>
            </div>
        </div>
        <div class="panel-body">
            {!! Form::open(['action' => ['Backend\BooksController@store'], 'method' => 'post','files'=>'true'], ['class'=>'form-horizontal']) !!}
            <div class="row">

                <div class="form-group col-md-3 col-lg-3">
                    {!! Form::hidden('author_id', Auth::id()) !!}
                    {!! Form::label('cover', trans('general.cover') , ['class' => 'control-label']) !!}*
                    {!! Form::file('cover', null,['class' => 'form-control','placeholder'=>
                    trans('general.cover')]) !!}
                </div>
                {{--<div class="form-group col-md-3 col-lg-3">
                    {!! Form::label('cover_en', trans('general.cover_en') , ['class' => 'control-label']) !!}*
                    {!! Form::file('cover_en',null,['class' => 'form-control','placeholder'=>
                    trans('general.cover_en')
                    ]) !!}
                </div>--}}
                <div class="form-group col-md-3 col-lg-3 {{ (Cache::get('Abilities.Admin')) ? '' : 'hidden' }}">
                    <div class="checkbox">
                        {{ trans('general.active') }}
                        <label>
                            {!! Form::checkbox('active',1,'checked') !!}
                        </label>
                    </div>

                </div>
            </div>
            <div class="form-group col-md-3 col-lg-3">
                {!! Form::label('title', trans('general.title'), ['class' => 'control-label']) !!}*
                {!! Form::text('title', null,['class' => 'form-control','placeholder'=> trans('general.title')]) !!}
            </div>

            <div class="form-group col-md-3 col-lg-3">

                {!! Form::label('field_category_id', trans('categories'), ['class' => 'control-label']) !!}*
                {!! Form::select('field_category_id', $fieldsCategories ,null, ['class' =>'form-control','style'=>'text-align:left!important;']) !!}
            </div>
            <div class="form-group col-md-3 col-lg-3">

                {!! Form::label('lang_category_id', trans('categories'), ['class' => 'control-label']) !!}*
                {!! Form::select('lang_category_id', $langsCategories ,null, ['class' =>
                'form-control','style'=>'text-align:left
                !important;']) !!}
            </div>
            <div class="row">
                <div class="form-group col-md-9 col-lg-9">
                    {!! Form::label('description', trans('general.description') , ['class' => 'control-label']) !!}*
                    {!! Form::textarea('description', null, ['class' => 'form-control','placeholder'=>
                    trans('general.description')]) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-lg-1">
                        {!! Form::submit(trans('general.save_draft'), ['class' => 'btn btn-primary']) !!}
                    </div>
                    <div class="col-lg-1 col-lg-offset-1">
                        <a class="btn btn-danger" href="{{ URL::previous() }}">{{ trans('general.cancel') }}</a>
                    </div>
                </div>

            </div>

            {!! Form::close() !!}
        </div>
    </div>

@stop