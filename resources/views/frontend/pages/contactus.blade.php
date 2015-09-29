@extends('frontend.layouts.one_col')
@section('content')
    <div class="row">

        @include('frontend.partials._form_contactus')

        <div class="col-xs-12 col-sm-6">
            <div class="well">
                <!-- START CONTENT ITEM -->
                <address>
                    <strong>{{ $contactusInfo->company }}</strong><br>
                    {{ $contactusInfo->address }}<br>
                    {{ $contactusInfo->zipcode }}<br>
                    {{ $contactusInfo->country }}<br>
                    <br>
                    <strong>{{ trans('word.phone') }}</strong>: {{ $contactusInfo->phone }}<br>
                    <strong>{{ trans('word.mobile') }}</strong>: {{ $contactusInfo->mobile }}<br>
                    <strong>{{ trans('word.email') }}</strong>: {{ $contactusInfo->email }}<br>
                </address>
                <div class="googlemap">
                    <img src="/img/logo.png" alt="" class="img-responsive text-center col-lg-3 col-md-3 col-lg-offset-4 col-md-offset-4"/>
                </div>
                <!-- END CONTENT ITEM -->

            </div>
        </div>

    </div>

@stop