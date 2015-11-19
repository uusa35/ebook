@extends('backend.layouts.dashboard')

@section('content')
    {!! Breadcrumbs::render('ad_edit') !!}


    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                {{ trans('messages.ads') }}
                <img class="img-responsive thumbnail" src="{{ asset('images/uploads/ads/large/'.$ad->ads) }}" alt=""/>
            </div>
            <div class="col-lg-6 col-lg-offset-3">
                {!! Form::open(['action'=>['Backend\AdsController@update',$id],'method'=>'put','files'=>'true'],['class'=>'form-horizontal']) !!}
                {!! Form::hidden('id',$id) !!}
                <div class="form-group">
                    {!! Form::label('ads',trans('general.ad')) !!}
                    {!! Form::file('ads',null,['class'=>'form-control','placeholder'=>trans('general.ad')]) !!}
                </div>
                @include('backend.partials.buttons.form_btn_update')
                {!! Form::close() !!}
            </div>
        </div>

    </div>

@stop