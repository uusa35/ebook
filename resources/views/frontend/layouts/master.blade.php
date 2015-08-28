<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    @section('styles')
        @include('frontend.styles.stylesheets')
    @show
</head>
<body>

@section('toolbar')
    @include('frontend.partials.toolbar')
@show

<div class="container">
    <div class="row">

        @section('header')

            @include('frontend.partials.header')

        @show


        @section('layout')
        @show

    </div>

</div>

@section('scripts')
    @include('frontend.scripts.allscripts')
@show
</body>
</html>