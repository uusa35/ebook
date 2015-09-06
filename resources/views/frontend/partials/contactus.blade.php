@extends('frontend.layouts.one_col')

@section('content')
<!-- CONTACT FOOTER --->
<div id="cf">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div id="mapwrap">
                    <iframe height="400" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.es/maps?t=m&amp;ie=UTF8&amp;ll=52.752693,22.791016&amp;spn=67.34552,156.972656&amp;z=6&amp;output=embed"></iframe>
                </div>
            </div><!--col-lg-8-->
            <div class="col-lg-4">
                <h4>ADDRESS<br/>Minsk - Head Office</h4>
                <br>
                <p>
                    Business Center, SomeAve 987,<br/>
                    Minsk, Belarus.
                </p>
                <p>
                    P: +55 4839-4390<br/>
                    F: +55 4333-4345<br/>
                    E: <a href="mailto:#">hello@linkagency.com</a>
                </p>
                <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
            </div><!--col-lg-4-->
        </div><!-- row -->
    </div><!-- container -->
</div><!-- Contact Footer -->
    @stop