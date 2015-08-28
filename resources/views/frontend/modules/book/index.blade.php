@extends('frontend.layouts.one_col')


@section('content')


    <div class="row">
        <div class="col-lg-12 z-shadow-1">
            <h3>Recent Books</h3> <hr>
        </div>
        @for($i=0;$i<=3;$i++)
            <div class="col-lg-3">
                <div class=" box box-widget widget-user shadow-z-1">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-white"
                         style="background: url('http://placehold.it/250x300') center center;">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">

                                    <h5 class="description-header"><i class="fa fa-fw fa-heart"></i></h5>
                                    <span class="description-text">122</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><i class="fa fa-fw fa-calendar"></i></h5>
                                    <span class="description-text">Test</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header"><i class="fa fa-fw fa-paper-plane"></i></h5>
                                    <span class="description-text">Test</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <span class="description-text">

                                    this is a test this is a test ...

                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        @endfor






        <div class="col-lg-12 z-shadow-1">
            <h3>Most Favorited Books</h3> <hr>
        </div>
        @for($i=0;$i<=3;$i++)
            <div class="col-lg-3">
                <div class=" box box-widget widget-user shadow-z-1">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-white"
                         style="background: url('http://placehold.it/250x300') center center;">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">

                                    <h5 class="description-header"><i class="fa fa-fw fa-heart"></i></h5>
                                    <span class="description-text">122</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><i class="fa fa-fw fa-calendar"></i></h5>
                                    <span class="description-text">Test</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header"><i class="fa fa-fw fa-paper-plane"></i></h5>
                                    <span class="description-text">Test</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <span class="description-text">

                                    this is a test this is a test ...

                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        @endfor






        <div class="col-lg-12 z-shadow-1">
            <h3>Most Liked Books</h3> <hr>
        </div>
        @for($i=0;$i<=3;$i++)
            <div class="col-lg-3">
                <div class=" box box-widget widget-user shadow-z-1">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-white"
                         style="background: url('http://placehold.it/250x300') center center;">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">

                                    <h5 class="description-header"><i class="fa fa-fw fa-heart"></i></h5>
                                    <span class="description-text">122</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><i class="fa fa-fw fa-calendar"></i></h5>
                                    <span class="description-text">Test</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header"><i class="fa fa-fw fa-paper-plane"></i></h5>
                                    <span class="description-text">Test</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <span class="description-text">

                                    this is a test this is a test ...

                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        @endfor

    </div>

    </div>

@stop