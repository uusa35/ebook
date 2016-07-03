<!DOCTYPE html>
<html>
<head lang="en">
    <!-- for FF, Chrome, Opera -->
    <link rel="icon" type="image/png" href="{{ public_path('icons/favicon-16x16.png') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ public_path('icons/favicon-32x32.png') }}" sizes="32x32" />
    <!-- for IE -->
    <link rel="icon" type="image/x-icon" href="http://sstatic.net/stackoverflow/img/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="http://sstatic.net/stackoverflow/img/favicon.ico">

    <meta charset="UTF-8">
    <title>7orof.com</title>
    @section('styles')
        @include('styles.stylesheets')
    @show
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="7orof is a book libarary for all authors.">
    <meta name="author" content="ideasowners.net">
    <meta name="keywords" content="books,book,author,kuwait,ksa,saudi,write,poem,thoughts,ideas,library,arabic">
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