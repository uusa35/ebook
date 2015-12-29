@extends('frontend.layouts.one_col')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        {{ trans('general.conditions') }}
                    </h4>
                </div>
                <div class="panel-body">
                    <h4>
                        {!!  (App::getLocale('lang') == 'ar') ? $conditions->title_ar : $conditions->title_en !!}
                    </h4>
                    {!! (App::getLocale('lang') == 'ar') ? $conditions->body_ar : $conditions->body_en !!}
                    <hr/>
                    <form class="form-virtical" action="">
                        <div class="form-group">
                            {!!
                            Form::checkbox('conditions',null,false,['id'=>'conditions','class'=>'control-label'])
                            !!}
                            {!! Form::label('read',trans('general.accept_conditions',['class'=>'form-control'])) !!}
                        </div>

                        <div class="form-group  {{ Session::get('pullClassReverse') }}"
                             style="padding:20px;">
                            <a class="btn btn-primary hidden" id="btncon" href="{{ action('Auth\AuthController@getRegister') }}"
                               disabled>{{ trans('general.register') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@stop
