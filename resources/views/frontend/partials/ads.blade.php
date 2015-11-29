<div class="row">
    <div class="col-lg-10 col-lg-offset-1 text-center">
        <hr/>
        @foreach($allAds as $ad)
        <div class="col-lg-6 col-xs-12" style="padding:3px;">
            <a href="{{ $ad->url }}" class="">
                <img class="img-responsive text-center"
                     src="{{ asset('images/uploads/ads/large/'.$ad->ads) }}"
                     alt=""/>
            </a>
        </div>
        @endforeach
    </div>
</div>