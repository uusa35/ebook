@extends('frontend.layouts.one_col')


@section('slider')
{{--@include('frontend.partials.slider')--}}
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
@stop

@section('styles')
    @parent
    <style type="text/css">
        #disqus_thread {
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }
    </style>
    <link rel="stylesheet" href="/css/lightbox.css"/>
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

                        <a data-lightbox="example-1" data-title="{{ $book->title }}"
                           href="{{ asset('images/uploads/cover/large/'.$book->cover) }}">

                            <img id="example-1" class="product-image img-responsive" style="padding: 4px; margin:10px;"
                                 src="{{ asset('images/uploads/cover/thumbnail/'.$book->cover) }}"
                                 alt="{{ $book->title }}">
                            {{--<div class="lightbox-caption"><p></p></div>--}}
                        </a>
                        {{--<div class="widget-user-header bg-white thumbnail"
                             style="background: url('{{ asset('images/uploads/cover/large/'.$book->cover) }}') center center; background-size: cover;">


                        </div>--}}
                    </div>
                    <div class="col-lg-8">
                        <table class="table-details table-bordered table-striped table-hover">
                            <tr>
                                <td class="tdtitle">
                                    {{ trans('general.serial') }} :
                                </td>
                                <td>
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
                                    {{ $total_pages }}
                                </td>
                            </tr>
                            <tr>
                                <td class="tdtitle">
                                    {{ trans('general.total_chapters') }} :
                                </td>
                                <td>
                                    {{ count($chaptersPublishedOnly) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="tdtitle">
                                    {{ trans('general.author') }} :
                                </td>
                                <td>
                                    <a href="{{ action('UserController@show',$book->author_id) }}">
                                        {{ $book->author->name }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="tdtitle">
                                    {{ trans('general.published_at') }} :
                                </td>
                                <td>
                                    {{ $book->created_at->toDateString() }}
                                </td>
                            </tr>
                            <tr>
                                <td class="tdtitle">
                                    {{ trans('general.views_counter') }}
                                </td>
                                <td>
                                    {{ $book->views }}
                                </td>
                            </tr>
                            <tr>
                                <td class="tdtitle"> {{ trans('general.likes_counter') }}</td>
                                <td> {{ count($book->usersLikes) }}</td>
                            </tr>
                            <tr>
                                <td class="tdtitle">
                                    {{ trans('general.read_book') }}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-material-light-blue-200"
                                            id="view-{{$book->id}}"
                                            title="{{ trans('general.chapters') }}"
                                            data-toggle="modal"
                                            data-target="#myModal">
                                        {!! Config::get('button.icon-view') !!}
                                        {{ trans('general.read_book') }}
                                    </button>
                                    @include('frontend.modules.book.chapter._chapters_modal')
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>


                @include('frontend.partials.ads')

                @if(Auth::user())
                    <div class="box-footer">

                        <div class="row ">
                            <div class="col-lg-6 col-lg-offset-4 {!! Session::get('pullClassReverse') !!}">
                                <div class="addthis_native_toolbox"></div>
                            </div>
                        </div>

                        <div class="row">
                            <hr/>
                            <div class="col-lg-8 col-lg-offset-2 col-xs-12 col-sm-12 text-center {!! Session::get('pullClassReverse') !!}">
                                <div class="col-lg-2 col-xs-3 col-sm-3 border-right text-center">
                                    <div class="description-block">
                                        @if(Auth::user())
                                            <a class=" {!! Config::get('button.btn-favorite') !!}"
                                               href="{{ action('Backend\BooksController@getCreateNewFavoriteList',[Auth::id(),$book->id]) }}"
                                               title="{{ trans('buttons.favorite') }}">
                                                {!! Config::get('button.icon-favorite') !!}
                                            </a>
                                        @endif
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <div class="col-lg-2 col-xs-3 col-sm-3 border-right">
                                    <div class="description-block">
                                        <a class=" {!! Config::get('button.btn-like') !!}"
                                           href="{{ action('Backend\BooksController@getCreateLikeBook',[ Auth::id(),$book->id]) }}"
                                           title="{{ trans('buttons.like') }}">
                                            {!! Config::get('button.icon-like') !!}
                                        </a>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <div class="col-lg-2 col-xs-3 col-sm-3 border-right">
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

                                <div class="col-lg-2 col-xs-3 col-sm-3 border-right">
                                    <div class="description-block">
                                        <a class=" {!! Config::get('button.btn-report') !!}"
                                           href="{{ action('Backend\BooksController@getCreateNewReportAbuse',[Auth::id(),$book->id]) }}"
                                                {{--data-toggle="modal"
                                                data-target="#reportAbuse"--}}
                                           title="{{ trans('buttons.report') }}">
                                            {!! Config::get('button.icon-report') !!}
                                        </a>
                                        {{--@include('frontend.partials._report_abuse_modal')--}}
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- /.widget-user -->
        </div>
    </div>
    @if(Auth::user())
        <div id="disqus_thread"></div>
        @if(!in_array(Auth::id(),$blockedUsersofAuthor,true))
            <div class="row">
                <div class="col-lg-12 ">
                    @include('CommentPack::Frontend.index')
                </div>
            </div>
                {{--@include('frontend.partials.comment')--}}
        @else
            <div class="row">
                <div class="alert alert-dismissable alert-warning">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <h4><i class="fa fa-fw fa-times"></i>{{ trans('general.warning') }}!</h4>

                    <p>{{  trans('messages.error.to_access_comments') }}.</p>
                </div>
            </div>
        @endif
    @else
        <div class="row">
            <div class="alert alert-dismissable alert-warning">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4><i class="fa fa-fw fa-info"></i>{{ trans('general.info') }}!</h4>

                <p>{{  trans('messages.info.register') }}. {!! link_to('auth/register',trans('general.register'))
                    !!}</p>
            </div>
        </div>
    @endif

@stop

@section('scripts')
    @parent
    <script src="/js/lightbox.min.js"></script>
@stop