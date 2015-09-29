@extends('backend.layouts.master')


@section('layout')

    <div class="row">

        <div class="col-lg-12" style="min-height: 1000px;">

            @include('backend.partials.notifications')

            <div class="box">

                <div class="panel panel-default">

                    @section('title')
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-lg-7">
                                    <h3>{{ Session::get('title') }}</h3>
                                </div>
                                {{-- any buttons that will be added --}}
                                <div class="col-lg-5 {{ Session::get('pullClassReverse') }}">
                                    @section('titlebar')
                                    @show
                                </div>
                            </div>w
                        </div>
                    @show

                    @yield('content')

                </div>

            </div>

        </div>
    </div>


@stop