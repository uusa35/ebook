@extends('frontend.layouts.one_col')


@section('slider')
    @include('frontend.partials.slider')
@stop

@section('content')


    <div class="row">
        {{-- Most Recent--}}
        <div class="col-lg-12 col-xs-12 z-shadow-1">
            <h3>{{ trans('general.most_recent') }}</h3>
            <hr>
        </div>
        <div class="row">
            @foreach($recentBooks as $book)

                <div class="col-lg-3  col-xs-10 col-md-offset-0 col-lg-offset-0 col-xs-offset-1">

                    <div class=" box box-widget widget-user shadow-z-1">

                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <a class="" href="{{ action('BookController@show',$book->id) }}">
                            <div class="widget-user-header bg-white"
                                 style="background: url('{{ asset('images/uploads/cover/thumbnail/'.$book->cover) }}') center center; background-size: cover;">
                            </div>
                        </a>

                        <div class="box-footer">
                            <div class="row">
                                <div class="col-lg-4 col-sm-4 col-xs-4 border-right">
                                    <div class="description-block">

                                        <h3 class="description-header"><i class="fa fa-fw fa-heart text-danger"></i>
                                        </h3>
                                        <span class="description-text">{{ count($book->usersFavorites) }}</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-xs-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header"><i class="fa fa-fw fa-calendar text-success"></i>
                                        </h5>
                                        <span class="description-text">{{ $book->created_at->toDateString() }}</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-xs-4">
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
                                    <a href="{{ action('BookController@show',$book->id) }}">
                                <span class="description-text">
                                    <h5>

                                        {{ \Illuminate\Support\Str::words($book->title,4) }}

                                    </h5>

                                    {{--{{ \Illuminate\Support\Str::words($book->description,3) }}--}}
                                    <a href="{{ action('UserController@show',$book->author_id) }}">
                                        {{ trans('general.author').' : '. $book->author->name }}
                                    </a>

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

        <div class="row">
            <div class="col-lg-2 col-lg-offset-10">
                <a href="{{ action('BookController@getRecentestBooksPage') }}"
                   class="btn btn-material-blue-500">{{ trans('general.more') }}</a>
            </div>
        </div>


        <div class="col-lg-12  col-xs-12 z-shadow-1">
            <h3>{{ trans('general.most_favorited') }}</h3>
            <hr>
        </div>
        <div class="row">
            <div class="col-lg-12 ">
                @foreach($mostFavoriteBooks as $book)

                    <div class="col-lg-3 col-md-3 col-xs-10 col-md-offset-0 col-lg-offset-0 col-xs-offset-1">

                        <div class=" box box-widget widget-user shadow-z-1">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <a class="" href="{!! action('BookController@show',$book->id) !!}">
                                <div class="widget-user-header bg-white"
                                     style="background: url('{{ asset('images/uploads/cover/thumbnail/'.$book->cover) }}') center center; background-size: cover;">
                                </div>
                            </a>

                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-sm-4 col-xs-4 border-right">
                                        <div class="description-block">

                                            <h3 class="description-header"><i class="fa fa-fw fa-heart text-danger"></i>
                                            </h3>
                                            <span class="description-text">{{ count($book->usersFavorites) }}</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 col-xs-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><i
                                                        class="fa fa-fw fa-calendar text-success"></i>
                                            </h5>
                                            <span class="description-text">{{ $book->created_at->toDateString() }}</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 col-xs-4">
                                        <div class="description-block">
                                            <h5 class="description-header"><i class="fa fa-fw fa-eye text-info"></i>
                                            </h5>
                                            <span class="description-text">{{ $book->views }}</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <a class="" href="{!! action('BookController@show',$book->id) !!}">
                                <span class="description-text">
                                    <h5>

                                        {{ \Illuminate\Support\Str::words($book->title,4) }}

                                    </h5>

{{--                                    {{ \Illuminate\Support\Str::words($book->description,3) }}--}}
                                    <a href="{{ action('UserController@show',$book->author_id) }}">
                                        {{ trans('general.author').' : '. $book->author->name }}
                                    </a>

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

        <div class="row">
            <div class="col-lg-2 col-lg-offset-10">
                <a href="{{ action('BookController@getMostFavoritedBooksPage') }}"
                   class="btn btn-material-blue-500">{{ trans('general.more') }}</a>
            </div>
        </div>


        {{--Most Liked Books--}}
        <div class="col-lg-12 col-xs-12 z-shadow-1">
            <h3>{{ ucfirst(trans('general.most_liked')) }}</h3>
            <hr>
        </div>
        <div class="row">
            @foreach($mostLikedBooks as $book)
                <div class="col-lg-3 col-md-3 col-xs-10 col-md-offset-0 col-lg-offset-0 col-xs-offset-1">

                    <div class=" box box-widget widget-user shadow-z-1">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <a class="" href="{!! action('BookController@show',$book->id) !!}">
                            <div class="widget-user-header bg-white"
                                 style="background: url('{{ asset('images/uploads/cover/thumbnail/'.$book->cover) }}') center center; background-size: cover;">
                            </div>
                        </a>

                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-4 col-xs-4 border-right">
                                    <div class="description-block">

                                        <h3 class="description-header"><i class="fa fa-fw fa-heart text-danger"></i>
                                        </h3>
                                        <span class="description-text">{{ count($book->usersFavorites) }}</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-xs-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header"><i class="fa fa-fw fa-calendar text-success"></i>
                                        </h5>
                                        <span class="description-text">{{ $book->created_at->toDateString() }}</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 col-xs-4">
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
                                    <a class="" href="{!! action('BookController@show',$book->id) !!}">
                                <span class="description-text">
                                    <h5>

                                        {{ \Illuminate\Support\Str::words($book->title,4) }}

                                    </h5>

                                    {{--{{ \Illuminate\Support\Str::words($book->description,3) }}--}}
                                    <a href="{{ action('UserController@show',$book->author_id) }}">
                                        {{ trans('general.author').' : '. $book->author->name }}
                                    </a>

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

        <div class="row">
            <div class="col-lg-2 col-lg-offset-10">
                <a href="{{ action('BookController@getMostLikedBooksPage') }}"
                   class="btn btn-material-blue-500">{{ trans('general.more') }}</a>
            </div>
        </div>

    </div>

@stop