<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    @section('styles')
        @include('styles.stylesheets')
    @show
</head>
<body>

@section('toolbar')
    @include('frontend.partials.toolbar')

@show
@section('header')
    @include('frontend.partials.header')
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
@show
</body>
</html>