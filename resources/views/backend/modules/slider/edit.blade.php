@extends('backend.layouts.dashboard')

@section('content')

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                {{ trans('messages.slider') }}

                <img class="img-responsive thumbnail" src="{{ asset('images/uploads/slide/thumbnail/'.$slide->slide) }}" alt=""/>
            </div>
            <div class="col-lg-6 col-lg-offset-3">
                {!! Form::open(['action'=>['Backend\SlidersController@update',$id],'method'=>'put','files'=>'true'],['class'=>'form-horizontal']) !!}
                {!! Form::hidden('id',$id) !!}
                <div class="form-group">
                    {!! Form::label('caption',trans('general.caption')) !!}
                    {!! Form::text('caption',$slide->caption,['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('slide',trans('general.slider')) !!}
                    {!! Form::file('slide',null,['class'=>'form-control','placeholder'=>trans('general.slider')]) !!}
                </div>
                @include('backend.partials.buttons.form_btn_update')
                {!! Form::close() !!}
            </div>
        </div>

    </div>

@stop