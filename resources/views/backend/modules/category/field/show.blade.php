@extends('backend.layouts.dashboard')

@section('title')
    E-Book Categories
@stop

@section('content')


    <div class="row">

        {{--Sub-Menu--}}
        @include('partials.sub-menu-category')

        <div class="col-xs-12 col-sm-9">


            <!-- START CONTENT ITEM -->
            <div class="row">
                <div class="col-xs-12 col-sm-9">
                    <h2>


                    </h2>
                </div>
            </div>
            <!-- END CONTENT ITEM -->



            <!-- START CONTENT ITEM -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="row product-list-inline-small">



                        <!-- START CONTENT ITEM -->
                        <div class="row" style="text-align: center">
                            @foreach($books as $book)
                                <div class="col-xs-12 col-md-3" style="margin:0px;">
                                    <div class=" product-list-inline-small">
                                        <div class="thumbnail">
                                            <a href="{{ action('BookController@show',$book->id) }}"><img src="/img/cover/cover_{{App::getLocale()}}/thumbnail/{{$book->cover }}" alt="{{ $book->title }}"></a>
                                            <div class="caption">
                                                <a href="{{ action('BookController@show',$book->id) }}"><h4>{{ $book->title }}</h4></a>
                                                <p>{{ \Str::words(strip_tags($book->body),2) }} </p>
                                                <span class="label label-info price pull-right">{{ ($book->free == 0) ? ($book->meta) ? $book->meta->price.' KD': '' :  trans('word.free') }}</span>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
            <!-- END CONTENT ITEM -->



        </div>

    </div>

    <div class="row">
        <div class="col-xs-12">

            <!-- START CONTENT ITEM -->
            {!! $books->render() !!}
            <!-- END CONTENT ITEM -->

        </div>
    </div>


@stop('content')

