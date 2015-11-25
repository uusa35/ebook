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
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">


        @section('header')
            @include('backend.partials.header')
            <div class="col-lg-2">
                @include('backend.partials.sidebar')
            </div>

        @show


        <div class="col-lg-10">
            <hr>


            @section('layout')
                @yield('content')
            @show


            <hr>
        </div>

        @include('backend.partials.footer')


        @section('scripts')
            @include('scripts.allscripts')
            <link rel="stylesheet" href="/css/flat.css"/>
        @show


    </div>
</body>
</html>