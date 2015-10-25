@extends('backend.layouts.dashboard')

@section('content')

    {!! Breadcrumbs::render('book_edit') !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-6">
                    <h3>{{ trans('general.book_edit') }}</h3>
                </div>
                <div class="col-lg-6">
                    <p style="color:red;">(*) - {{ trans('messages.fields_required') }}</p>

                    <p style="color:red;">(*) - {{ trans('messages.cover_instructions') }}</p>
                </div>
            </div>
        </div>
        <div class="panel-body">
            {!! Form::model($book,['action' => ['Backend\BooksController@update',$book->id], 'method' =>
            'PATCH','files'=>'true'], ['class'=>'form-horizontal']) !!}
            {!! Form::hidden('id',$book->id)!!}
            <div class="row">
                <div class="row page-header">
                    <div class="col-lg-2 col-md-2 col-lg-offset-4">
                        <img class="img-thumbnail img-responsive "
                             src="{{ asset('images/uploads/cover/thumbnail/'.$book->cover ) }}" alt="">
                    </div>
                    {{--<div class="col-lg-2 col-md-2 ">
                        <img class="img-thumbnail img-responsive "
                             src="{{ asset('images/uploads/cover_en/thumbnail/'.$book->cover_en) }}" alt="">
                    </div>--}}
                </div>
                <div class="form-group col-md-3 col-lg-3">
                    {!! Form::label('cover', trans('general.cover_ar') , ['class' => 'control-label']) !!}*
                    {!! Form::file('cover', null,['class' => 'form-control','placeholder'=>
                    trans('general.cover')
                    ]) !!}
                </div>
                {{--<div class="form-group col-md-3 col-lg-3">
                    {!! Form::label('cover_en', trans('general.cover_en') , ['class' => 'control-label']) !!}*
                    {!! Form::file('cover_en',null,['class' => 'form-control','placeholder'=>
                    trans('general.cover_en')
                    ]) !!}
                </div>--}}
                <div class="form-group col-md-3 col-lg-3">
                    <div class="checkbox">
                        {{ trans('general.active') }}
                        <label>
                            {!! Form::checkbox('active[]', $book->active , (in_array($book->active,['1'],'true')) ? true : '') !!}
                        </label>
                    </div>

                </div>
            </div>
            <div class="form-group col-md-3 col-lg-3">
                {!! Form::label('title', trans('general.title'), ['class' => 'control-label']) !!}*
                {!! Form::text('title', null, ['class' => 'form-control','placeholder'=> trans('general.title')]) !!}
            </div>
            {{--<div class="form-group col-md-3 col-lg-3">
                {!! Form::label('title_en', 'Title In English', ['class' => 'control-label']) !!}*
                {!! Form::text('title_en', null, ['class' => 'form-control','placeholder'=>'Book Title in English']) !!}
            </div>

            <div class="form-group col-md-3 col-lg-3">
                {!! Form::label('title_ar', 'Title In Arabic', ['class' => 'control-label']) !!}*
                {!! Form::text('title_ar', null, ['class' => 'form-control','placeholder'=>'Book Title in Arabic']) !!}
            </div>--}}

            <div class="form-group col-md-3 col-lg-3">

                {!! Form::label('field_category_id', trans('categories'), ['class' => 'control-label']) !!}*
                {!! Form::select('field_category_id', $fieldsCategories ,null, ['class' =>
                'form-control','style'=>'text-align:left
                !important;']) !!}
            </div>
            <div class="form-group col-md-3 col-lg-3">

                {!! Form::label('lang_category_id', trans('categories'), ['class' => 'control-label']) !!}*
                {!! Form::select('lang_category_id', $langsCategories ,null, ['class' =>
                'form-control','style'=>'text-align:left
                !important;']) !!}
            </div>
            <div class="row">
                <div class="form-group col-md-6 col-lg-6">
                    {!! Form::label('description', trans('general.description') , ['class' => 'control-label']) !!}*
                    {!! Form::textarea('description', null, ['class' => 'form-control','placeholder'=>
                    trans('general.descrption')]) !!}
                </div>
                {{--<div class="form-group col-md-6 col-lg-6">
                    {!! Form::label('description_ar', trans('description-ar') , ['class' => 'control-label']) !!}*
                    {!! Form::textarea('description_ar', null, ['class' => 'form-control','placeholder'=>
                    trans('descrption-ar')]) !!}
                </div>
                <div class="form-group col-md-6 col-lg-6">
                    {!! Form::label('description_en', trans('description-en') , ['class' => 'control-label']) !!}*
                    {!! Form::textarea('description_en', null, ['class' => 'form-control','placeholder'=>
                    trans('descrption-en')]) !!}
                </div>--}}
            </div>

            @include('backend.partials.buttons.form_btn_update')

            {!! Form::close() !!}
        </div>
    </div>

@stop