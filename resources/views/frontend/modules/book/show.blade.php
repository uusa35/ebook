@extends('frontend.layouts.one_col')


@section('slider')
    {{--@include('frontend.partials.slider')--}}
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
@stop

@section('content')


    <div class="row">
        <div class="col-lg-12 z-shadow-1">
            <h3>{{ $book->title }}</h3>
            <hr>
        </div>
        <div class="col-lg-12">
            <div class=" box box-widget widget-user shadow-z-1">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="widget-user-header bg-white thumbnail"
                             style="background: url('{{ asset('images/uploads/cover/large/'.$book->cover) }}') center center; background-size: cover;"></div>
                    </div>
                    <div class="col-lg-8">
                        <table class="table-details table-bordered table-striped table-hover">
                            <tr>
                                <td class="tdtitle">
                                    {{ trans('general.serial') }} :
                                </td>
                                <td class="tdtitle">
                                    {{ $book->serial }}
                                </td>
                            </tr>
                            <tr>
                                <td class="tdtitle">
                                    {{ trans('general.description') }} :
                                </td>
                                <td>
                                    <p>
                                        {{ $book->description }}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td class="tdtitle">
                                    {{ trans('general.total_pages') }} :
                                </td>
                                <td>
                                    {{ $book->meta->total_pages }}
                                </td>
                            </tr>
                            <tr>
                                <td class="tdtitle">
                                    {{ trans('general.total_chapters') }} :
                                </td>
                                <td>
                                    {{ $book->meta->total_chapters }}
                                </td>
                            </tr>
                            <tr>
                                <td class="tdtitle">
                                    {{ trans('general.author') }} :
                                </td>
                                <td>
                                    {{ $book->author->name }}
                                </td>
                            </tr>
                            <tr>
                                <td class="tdtitle">
                                    {{ trans('general.published_at') }} :
                                </td>
                                <td>
                                    {{ $book->updated_at->format('Y-M-D') }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {{ trans('general.views_counter') }}
                                </td>
                                <td>
                                    {{ $book->views }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="box-footer">

                    <div class="row ">
                        <div class="col-lg-6 col-lg-offset-4 {!! Session::get('pullClassReverse') !!}">
                            <div class="addthis_native_toolbox"></div>
                        </div>
                    </div>

                    <div class="row">
                        <hr/>
                        <div class="col-lg-8 col-lg-offset-2 text-center {!! Session::get('pullClassReverse') !!}">
                            <div class="col-lg-2 border-right text-center">
                                <div class="description-block">
                                    <a class=" {!! Config::get('button.btn-favorite') !!}" href="{{ action('BookController@getCreateNewFavoriteList',[Auth::id(),$book->id]) }}"
                                       title="{{ trans('buttons.favorite') }}">
                                        {!! Config::get('button.icon-favorite') !!}
                                    </a>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <div class="col-lg-2 border-right">
                                <div class="description-block">
                                    <a class=" {!! Config::get('button.btn-like') !!}" href=""
                                       title="{{ trans('buttons.like') }}">
                                        {!! Config::get('button.icon-like') !!}
                                    </a>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <div class="col-lg-2 border-right">
                                <div class="description-block">

                                    <button type="button" class="{{ Config::get('button.btn-view') }}"
                                            id="view-{{$book->id}}"
                                            title="{{ trans('general.chapters') }}"
                                            data-toggle="modal"
                                            data-target="#myModal">
                                        {!! Config::get('button.icon-view') !!}
                                    </button>
                                    @include('frontend.modules.book.chapter._chapters_modal')
                                </div>
                                <!-- /.description-block -->
                            </div>
                            @if(Auth::user())
                                <div class="col-lg-2 border-right">
                                    <div class="description-block">
                                        <a class=" {!! Config::get('button.btn-report') !!}" href=""
                                           title="{{ trans('buttons.report') }}">
                                            {!! Config::get('button.icon-report') !!}
                                        </a>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                                <span class="description-text text-center text-danger">

                                    {{--this is a test this is a test ...--}}

                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>

        <div id="disqus_thread"></div>

        @include('frontend.partials.comment')
    </div>

    </div>
@stop