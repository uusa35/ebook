@extends('frontend.layouts.one_col')

@section('content')
<!-- CONTACT FOOTER --->
<div id="cf">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-lg-6">
                <div class="well">
                    <!-- START CONTENT ITEM -->
                    <div class="googlemap col-lg-12">
                        <img src="{{ asset('images/logo-150.png') }}" alt="" class="img-responsive text-center col-lg-3 col-md-3 col-lg-offset-4 col-md-offset-4"/>
                    </div>
                    <address>
                        <strong>{{ $contactusInfo->company }}</strong><br>
                        {{ $contactusInfo->address }}<br>
                        {{ $contactusInfo->zipcode }}<br>
                        {{ $contactusInfo->country }}<br>
                        <br>
                        <strong>{{ trans('general.phone') }}</strong>: {{ $contactusInfo->phone }}<br>
                        <strong>{{ trans('general.mobile') }}</strong>: {{ $contactusInfo->mobile }}<br>
                        <strong>{{ trans('general.email') }}</strong>: {{ $contactusInfo->email }}<br>
                    </address>

                    <div id="mapwrap">
                        <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;height:429px;width:495px;'><div id='gmap_canvas' style='height:429px;width:686px;'></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div> <a href='http://maps-generator.com/'>maps-generator</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=dd98a226f5a20bd4b388befc42e008b326a2249a'></script><script type='text/javascript'>function init_map(){var myOptions = {zoom:12,center:new google.maps.LatLng(29.39,48.003056000000015),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(29.39,48.003056000000015)});infowindow = new google.maps.InfoWindow({content:'<strong>kuwait</strong><br>kuwait towers<br> <br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>

                    </div>
                    <!-- END CONTENT ITEM -->

                </div>
            </div>

            <div class="col-lg-6 col-xs-12">
                <h4>{{trans('general.contactus')}}</h4>
                <hr/>
                @include('frontend.partials._form_contactus')
            </div><!--col-lg-8-->

        </div><!-- row -->
    </div><!-- container -->
</div><!-- Contact Footer -->
    @stop