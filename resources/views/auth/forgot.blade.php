@extends('frontend.layouts.one_col')

@section('content')
    <h3>{{{ trans('word.forgot-password') }}}</h3>
        <div class="row">
            {!! Form::open(['action'=>'UserController@postUserForgetPassword','method'=>'post','role'=>'form','class'=>'form-horizontal']) !!}
            <div class="form-group">

            <label class="col-md-4 control-label">{{ trans('word.email') }}*</label>
                <div class="col-md-6">
                    <input class="form-control" placeholder="{{ trans('word.email') }}" type="email" name="email" id="email" value="{{{ Input::old('email') }}}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-success">
                        {{ trans('word.submit') }}
                    </button>
                </div>
            </div>

        {!! Form::close() !!}
        </div>
@stop
