<hr/>
<div class="row well-material-grey-100">
    <div class="col-lg-10 col-lg-offset-1">


        <div class="col-lg-3">
            <h3>{{ ucfirst(trans('general.contactus')) }}</h3>

            <p><i class="fa fa-fw fa-home"></i> {{ $contactusInfo->address }}<br/>
                <i class="fa fa-fw fa-phone"></i> {{ $contactusInfo->phone }}<br/>
                <i class="fa fa-fw fa-mobile"></i>{{ $contactusInfo->mobile }}<br/>
                <i class="fa fa-fw fa-envelope"></i><a href="#"> {{ $contactusInfo->email }}</a> <br/>
                <span class="fa fa-fw fa-twitter"></span> <a href="#"> {{ $contactusInfo->twitter }}</a> <br/>
                <span class="fa fa-fw fa-instagram"></span> <a href="#"> {{ $contactusInfo->instagram }}</a> <br/>
                <span class="fa fa-fw fa-youtube"></span> <a href="#"> {{ $contactusInfo->youtube }}</a>
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
            <h3>{{ ucfirst(trans('conditions')) }}</h3>
            <h4>{{ $conditions->title_en }}</h4>

            <p>{{ $conditions->body_en }}.</p>
        </div>
        <!-- col -->
        <div class="col-lg-3">
            <h3>{{ ucfirst(trans('conditions')) }}</h3>
            <h4>{{ $conditions->title_ar }}</h4>

            <p>{{ $conditions->body_ar }}.</p>
        </div>
        <!-- col -->

    </div>
</div><!-- row -->

