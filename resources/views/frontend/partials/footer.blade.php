<hr/>
<div class="row well-material-grey-100">
    <div class="col-lg-10 col-lg-offset-1">


        <div class="col-lg-3">
            <h3>{{ ucfirst(trans('general.contactus')) }}</h3>

            <p><i class="fa fa-fw fa-home"></i> {{ $contactusInfo->address }}<br/>
                <i class="fa fa-fw fa-phone"></i> {{ $contactusInfo->phone }}<br/>
                <i class="fa fa-fw fa-mobile"></i>{{ $contactusInfo->mobile }}<br/>
                <i class="fa fa-fw fa-envelope"></i><a href="{{ $contactusInfo->email }}"> {{ $contactusInfo->email }}</a> <br/>
                <span class="fa fa-fw fa-twitter"></span> <a href="http://twitter.com/{{ $contactusInfo->twitter }}"> {{ $contactusInfo->twitter }}</a> <br/>
                <span class="fa fa-fw fa-instagram"></span> <a href="http://instagram.com/{{ $contactusInfo->instagram }}"> {{ $contactusInfo->instagram }}</a> <br/>
                <span class="fa fa-fw fa-youtube"></span> <a href="http://youtube.com/{{ $contactusInfo->youtube }}"> {{ $contactusInfo->youtube }}</a>
            </p>
        </div>
        <!-- col -->

        <div class="col-lg-3">
            <h3>{{ ucfirst(trans('general.newsletter')) }}</h3>

            <p>{{ trans('messages.newsletter_message') }}</p>

            <p>

            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="inputEmail1" class="col-lg-4 control-label"></label>

                    <div class="col-lg-10">
                        <input type="email" class="form-control" id="inputEmail1" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="text1" class="col-lg-4 control-label"></label>

                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="text1" placeholder="Your Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10">
                        <button type="submit" class="btn btn-success">{{ trans('general.subscribe') }}</button>
                    </div>
                </div>
            </form>
            <!-- form -->
            </p>
        </div>
        <!-- col -->

        <div class="col-lg-3">
            <h3>{{ trans('general.instagram') }}</h3>

            <p>
                <!-- SnapWidget -->
                <script src="http://snapwidget.com/js/snapwidget.js"></script>
                <iframe src="http://snapwidget.com/in/?u=dXVzYTM1fGlufDMwfDN8M3x8bm98MXxmYWRlSW58b25TdGFydHx5ZXN8eWVz&ve=081115" title="Instagram Widget" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%;"></iframe>
            </p>
        </div>
        <!-- col -->
        <div class="col-lg-3">
            <h3>{{ trans('general.twitter') }}</h3>

            <p>
                <a class="twitter-timeline" href="https://twitter.com/UsamaIIAhmed" data-widget-id="352804064125415424">Tweets by @UsamaIIAhmed</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </p>
        </div>
        <!-- col -->
    </div>
    <div class="col-lg-12 text-center text-info">
        {{ trans('messages.allrights') }} - {{ trans('messages.designed_developed') }} - <a href="http://ideasowneres.net">{{ trans('general.ideasowners') }}</a>
        <br/>
    </div>

</div><!-- row -->

