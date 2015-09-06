<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    @section('styles')
        @include('styles.stylesheets')
    @show
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
    @show


</div>
</body>
</html>