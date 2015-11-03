@extends('frontend.layouts.one_col')


@section('slider')
    @include('frontend.partials.slider')
@stop

@section('content')


    <div class="row">
        {{-- Most Recent--}}
        <div class="col-lg-12 z-shadow-1">
            <h3>{{ trans('general.most_recent') }}</h3>
            <hr>
        </div>
        @foreach($recentBooks as $book)
            <div class="col-lg-3">

                <div class=" box box-widget widget-user shadow-z-1">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <a class="" href="{{ action('BookController@show',$book->id) }}">
                        <div class="widget-user-header bg-white"
                             style="background: url('{{ asset('images/uploads/cover/thumbnail/'.$book->cover) }}') center center; background-size: cover;">
                        </div>
                    </a>

                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">

                                    <h3 class="description-header"><i class="fa fa-fw fa-heart text-danger"></i></h3>
                                    <span class="description-text">{{ count($book->usersFavorites) }}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><i class="fa fa-fw fa-calendar text-success"></i>
                                    </h5>
                                    <span class="description-text">{{ $book->updated_at->format('d-m-y')}}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header"><i class="fa fa-fw fa-eye text-info"></i></h5>
                                    <span class="description-text">{{ $book->views }}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <a class="" href="{{ action('BookController@show',$book->id) }}">
                                <span class="description-text">
                                    <h5>
                                        <blockquote>
                                            {{ \Illuminate\Support\Str::words($book->title,4) }}
                                        </blockquote>
                                    </h5>

                                    {{ \Illuminate\Support\Str::words($book->description,3) }}

                            </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        @endforeach






        <div class="col-lg-12 z-shadow-1">
            <h3>{{ trans('general.most_favorited') }}</h3>
            <hr>
        </div>
        @foreach($mostFavoriteBooks as $book)
            <div class="col-lg-3">

                <div class=" box box-widget widget-user shadow-z-1">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <a class="" href="{{ action('BookController@show',$book->id) }}">
                        <div class="widget-user-header bg-white"
                             style="background: url('{{ asset('images/uploads/cover/thumbnail/'.$book->cover) }}') center center; background-size: cover;">
                        </div>
                    </a>

                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">

                                    <h3 class="description-header"><i class="fa fa-fw fa-heart text-danger"></i></h3>
                                    <span class="description-text">{{ count($book->usersFavorites) }}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><i class="fa fa-fw fa-calendar text-success"></i>
                                    </h5>
                                    <span class="description-text">{{ $book->updated_at->format('d-m-y')}}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header"><i class="fa fa-fw fa-eye text-info"></i></h5>
                                    <span class="description-text">{{ $book->views }}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <a class="" href="{{ action('BookController@show',$book->id) }}">
                                <span class="description-text">
                                    <h5>
                                        <blockquote>
                                            {{ \Illuminate\Support\Str::words($book->title,4) }}
                                        </blockquote>
                                    </h5>

                                    {{ \Illuminate\Support\Str::words($book->description,3) }}

                            </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        @endforeach






        <div class="col-lg-12 z-shadow-1">
            <h3>Most Liked Books</h3>
            <hr>
        </div>
        @foreach($mostLikedBooks as $book)
            <div class="col-lg-3">

                <div class=" box box-widget widget-user shadow-z-1">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <a class="" href="{{ action('BookController@show',$book->id) }}">
                        <div class="widget-user-header bg-white"
                             style="background: url('{{ asset('images/uploads/cover/thumbnail/'.$book->cover) }}') center center; background-size: cover;">
                        </div>
                    </a>

                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">

                                    <h3 class="description-header"><i class="fa fa-fw fa-heart text-danger"></i></h3>
                                    <span class="description-text">{{ count($book->usersFavorites) }}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><i class="fa fa-fw fa-calendar text-success"></i>
                                    </h5>
                                    <span class="description-text">{{ $book->updated_at->format('d-m-y')}}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header"><i class="fa fa-fw fa-eye text-info"></i></h5>
                                    <span class="description-text">{{ $book->views }}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <a class="" href="{{ action('BookController@show',$book->id) }}">
                                <span class="description-text">
                                    <h5>
                                        <blockquote>
                                            {{ \Illuminate\Support\Str::words($book->title,4) }}
                                        </blockquote>
                                    </h5>

                                    {{ \Illuminate\Support\Str::words($book->description,3) }}

                            </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        @endforeach

    </div>

    </div>
@stop