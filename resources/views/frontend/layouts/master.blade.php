<!DOCTYPE html>
<html>
<head lang="en">
    <link href="{{ asset('icons/logo.ico') }}" rel="shortcut icon" type="image/x-icon">
    <meta charset="UTF-8">
    <title>7orof.com</title>
    @section('styles')
        @include('styles.stylesheets')
    @show
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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