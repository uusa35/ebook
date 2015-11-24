<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>7orof.com</title>
    @section('styles')
        @include('styles.stylesheets')
    @show
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-70043308-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>
<body>


@section('header')
    @include('frontend.partials.header')
@show

@section('toolbar')
    @include('frontend.partials.toolbar')

@show


@yield('slider')

<div class="container">

    <div class="row">


        @section('layout')
        @show

    </div>
</div>

@include('frontend.partials.footer')


@section('scripts')
    @include('scripts.allscripts')
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55ec96e5477030d8"
            async="async"></script>
@show
</body>
</html>