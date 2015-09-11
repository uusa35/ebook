{{--Favorites--}}


    <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">


        <div class="panel panel-success">
            <div class="panel-heading">
                <!-- START CONTENT ITEM -->
                <div class="row">
                    <div class="col-xs-12 col-sm-9">
                        <h3>{{ trans('word.most-favorited') }} </h3>
                    </div>
                </div>
                <!-- END CONTENT ITEM -->
            </div>
            <div class="panel-body">
                <!-- START CONTENT ITEM -->
                <div class="row" style="text-align: center">
                    @foreach($mostFavoriteBooks as $book)
                        <div class="col-xs-12 col-md-3" style="margin:0px;">
                            <div class=" product-list-inline-small">
                                <div class="thumbnail">
                                    <a href="{{ action('BookController@show',$book->id) }}"><img class="img-responsive product-small" src="/img/cover/cover_{{App::getLocale()}}/thumbnail/{{ $book->__get('cover') }}" alt=""></a>
                                    <div class="caption">
                                        <a href="{{ action('BookController@show',$book->id) }}"><h4>{{ Str::words($book->__get('title'),2) }}</h4></a>
                                        <p>{!! Str::words(strip_tags($book->__get('body')),2) !!} </p>
                                        <span class="label label-info price pull-right">{{ ($book->free == 0) ?  ($book->meta ? $book->meta->price.' KD' : ''): trans('word.free') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- END CONTENT ITEM -->
            </div>
        </div>

    </div>

    {{--@include('partials._left_side')--}}

