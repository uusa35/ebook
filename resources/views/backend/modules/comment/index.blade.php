@extends('backend.layouts.dashboard')


@section('slider')
    {{--@include('frontend.partials.slider')--}}
@stop

@section('content')


    <div class="panel-body">

        <style>
            .comment {
                background-color: #c0c0c0;
                border-style: solid;
                border-width: thin;
                width: 500px;
                margin-bottom: 10px;
            }

            .postRef {
                font-size: 12px;
                font-style: italic;
                text-align: right;
            }
        </style>

        <div id="comments"></div>

    </div>

@stop