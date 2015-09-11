{{--latest added--}}

    <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">


        <!-- START CONTENT ITEM -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12 col-sm-9">
                        <h3>{{ trans('word.last-created') }} </h3>
                    </div>
                </div>
                <!-- END CONTENT ITEM -->
            </div>
            <div class="panel-body">
                <!-- START CONTENT ITEM -->
                <div class="row" style="text-align: center">
                    @foreach($books as $book)

                        <div class="col-xs-12 col-md-3" style="margin:0px;">
                            <div class=" product-list-inline-small">
                                <div class="thumbnail">
                                    <a href="{{ action('BookController@show',$book->id) }}"><img class="img-responsive product-small"
                                                                                                 src="/img/cover/cover_{{App::getLocale()}}/thumbnail/{{$book->cover }}"
                                                                                                 alt=""></a>

                                    <div class="caption">
                                        <div class="row">
                                            <a href="{{ action('BookController@show',$book->id) }}">
                                                <h4>{!! Str::words($book->title,2) !!}</h4></a>

                                            <p>{!! Str::words(strip_tags($book->__get('body')),2) !!} </p>
                                            <span class="label label-info price pull-right">{{ ($book->free == 0) ? ($book->meta ? $book->meta->price.' KD' : ''): e(trans('word.free')) }}</span>
                                        </div>
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


