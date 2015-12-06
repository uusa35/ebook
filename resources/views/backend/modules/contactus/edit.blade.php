@extends('backend.layouts.dashboard')

@section('content')

    {!! Breadcrumbs::render('contactus') !!}

    <div class="panel-body">
        {!! Form::model($contactInfo, ['action' => ['Backend\ContactUsController@update'], 'method' => 'post'],
        ['class'=>'form-horizontal']) !!}

        <div class="form-group col-md-4 col-lg-4">
            {!! Form::label('company', trans('general.company'), ['class' => 'control-label']) !!}
            {!! Form::text('company', $contactInfo->company, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-md-2 col-lg-2">
            {!! Form::label('phone', trans('general.phone'), ['class' => 'control-label']) !!}
            {!! Form::text('phone', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-2 col-lg-2">
            {!! Form::label('mobile', trans('general.mobile'), ['class' => 'control-label']) !!}
            {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4 col-lg-4">
            {!! Form::label('email', trans('general.email'), ['class' => 'control-label']) !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-1 col-lg-1">
            {!! Form::label('zipcode', trans('general.zipcode'), ['class' => 'control-label']) !!}
            {!! Form::text('zipcode', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-2 col-lg-2">
            {!! Form::label('country', trans('general.country'), ['class' => 'control-label']) !!}
            {!! Form::text('country', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-md-3 col-lg-3">
            {!! Form::label('youtube', trans('general.youtube'), ['class' => 'control-label']) !!}
            {!! Form::text('youtube', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-3 col-lg-3">
            {!! Form::label('instagram', trans('general.instagram'), ['class' => 'control-label']) !!}
            {!! Form::text('instagram', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-3 col-lg-3">
            {!! Form::label('twitter', trans('general.twitter'), ['class' => 'control-label']) !!}
            {!! Form::text('twitter', null, ['class' => 'form-control']) !!}
        </div>


        <div class="form-group col-md-12 col-lg-12">
            {!! Form::label('address', trans('general.address'), ['class' => 'control-label']) !!}
            {!! Form::textarea('address', null, ['class' => 'form-control editor','placeholder'=>trans('general.address')])
            !!}
        </div>

        <div class="form-group col-md-12 col-lg-12">
            {!! Form::label('aboutus', trans('general.aboutus'), ['class' => 'control-label']) !!}
            {!! Form::textarea('aboutus', null, ['class' => 'form-control editor','placeholder'=>trans('general.aboutus')])
            !!}
        </div>

        @include('backend.partials.buttons.form_btn_update')

        {!! Form::close() !!}
    </div>


@stop