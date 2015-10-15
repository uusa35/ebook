<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-9">
                    <h1>{{ trans('general.ebook') }}
                        <small>| e-boook.com</small>
                    </h1>
                </div>
                <div class="col-lg-2">
                    <img class="{{ Session::get('pullClassReverse') }} img-responsive img-circle"
                         src="{!! asset('images/logo.png') !!}" alt="" style="max-width:100px;"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('frontend.partials.notifications')
            </div>
        </div>
    </div>
</div>


