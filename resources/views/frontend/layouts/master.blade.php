<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    @section('styles')
        @include('styles.stylesheets')
    @show
    <meta name="csrf-token" content="{{ csrf_token() }}">
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