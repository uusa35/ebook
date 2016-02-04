@extends('frontend.layouts.one_col')

@section('content')


    <div class="row">
        {{-- Most Recent--}}
        <div class="col-lg-12 z-shadow-1">
            <h3>{{ trans('general.all_books') }}</h3>
            <hr>
        </div>
        @if(count($allBooks) > 0)
            <div class="row">
                @foreach($allBooks as $book)
                    <div class="col-lg-3 col-md-3 col-xs-10 col-md-offset-0 col-lg-offset-0 col-xs-offset-1">

                        <div class=" box box-widget widget-user shadow-z-1">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <a class="" href="{{ action('BookController@show',$book->id) }}">
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
                                            <span class="description-text">{{ $book->created_at->toDateString()}}</span>
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
                                        <a class="" href="{{ action('BookController@show',$book->id) }}">
                                <span class="description-text">
                                    <h5>
                                        {{ \Illuminate\Support\Str::words($book->title,4) }}
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
            <div class="row">
                <div class="col-lg-4 col-xs-6 col-xs-3 col-lg-offset-4 text-center">
                    {!! $allBooks->render() !!}
                </div>
            </div>
        @else
            <div class="row">
                <div class="alert alert-dismissable alert-warning">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <h4><i class="fa fa-fw fa-times"></i>{{ trans('general.info') }}</h4>

                    <p>{{  trans('messages.error.no_results') }}.</p>
                </div>
            </div>
        @endif

    </div>


@stop