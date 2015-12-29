@extends('backend.layouts.dashboard')

@section('styles')
    @parent
    <style type="text/css">
        #myModal {
            z-index: 9999999;
        }

        .nav-tabs > li .active {
            color: darkmagenta !important;
        }
    </style>
@stop
@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            $('#booksTable').DataTable({
                "order": [["0", "asc"]]
            });
            $('#booksFavorited').DataTable({
                "order": [[0, "asc"]]
            });
            $('#bookReport').DataTable({
                "order": [[0, "asc"]]
            });
            $('#bookPreviews').DataTable({
                "order": [[0, "asc"]]
            });
            $("button[id^='delete-']").on('click', function () {
                var btnId = $(this).attr('id');
                var element = btnId.split("-", 2);
                var btnId = element[1];
                var action = $('#formDelete').attr('action');
                var action = action.split('%', 2);
                var action = (action[0] + btnId);
                $('#formDelete').attr('action', action);
            });
        });
    </script>
@stop

@section('content')
    {!! Breadcrumbs::render('books') !!}

    <div class="panel-body">
        @section('titlebar')
            @can('create','book_create')
            <a class="{{ Config::get('button.btn-create') }} hidden-xs"
               href="{{ action('Backend\BooksController@create') }} hidden-xs"
               title="{{ trans('general.book_create') }}">
                {!! Config::get('button.icon-create')!!}
                <span class="small-text"> {{ trans('general.book_create') }}</span>
            </a>
            @endcan
        @stop

        <div class="row">
            <div class="col-xs-12">

                <!-- START CONTENT ITEM -->
                <ul class="nav nav-tabs btn-material-blue-grey-400">
                    <li id="tab-1" class="" href="#step1"><a href="#step1" data-toggle="tab"><i
                                    class="fa fa-aw fa-book"></i>&nbsp;{{ trans('general.volumes') }} </a></li>
                    <li id="tab-2"><a href="#step2" data-toggle="tab"><i
                                    class="fa fa-aw fa-exclamation-triangle"></i>&nbsp;{{ trans('general.favorite') }}
                        </a></li>
                    @if(Request::user()->isAdmin())
                        <li id="tab-3"><a href="#step3" data-toggle="tab"><i
                                        class="fa fa-aw fa-exclamation-triangle"></i>&nbsp;{{ trans('general.report') }}
                            </a></li>
                    @endif
                    @if(Request::user()->isAuthor())
                        <li id="tab-4"><a href="#step4" data-toggle="tab"><i
                                        class="fa fa-aw fa-exclamation-triangle"></i>&nbsp;{{ trans('general.preview') }}
                            </a></li>
                    @endif
                </ul>

                {{--All Books--}}

                <div class="tab-content">

                    <div class="tab-pane active" id="step1">
                        <div class="row">
                            <div class="col-xs-12 paddingTop10">
                                @if($books->count() > 0)
                                    <table class="table table-striped table-condensed table-hover" id="booksTable">
                                        <thead>
                                        <tr class="well-material-blue-grey-100">
                                            <th>{{ trans('general.serial') }}</th>
                                            <th class="hidden-xs">{{ trans('general.title') }}</th>
                                            <th class="hidden-xs">{{ trans('general.author') }}</th>
                                            <th class="hidden-xs">{{ trans('general.chapters') }}</th>
                                            <th class="hidden-xs">{{ trans('general.created_at') }}</th>
                                            <th>{{ trans('general.view') }}</th>
                                            <th>{{ trans('general.add') }}</th>
                                            <th>{{ trans('general.active') }}</th>
                                            <th>{{ trans('general.edit') }}</th>
                                            @if(Request::user()->isAdminSession())
                                                <th>{{ trans('general.delete') }}</th>
                                            @endif
                                            <th>{{ trans('general.send_message') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($books as $book)
                                            <tr>
                                                <td>{{ $book->serial }}</td>
                                                <td class="hidden-xs">
                                                    <a href="{{ action('Backend\BooksController@show', $book->id) }}">
                                                        {{ $book->title }} </a>
                                                </td>
                                                <td class="hidden-xs">
                                                    @if(!is_null($book->author->name))
                                                        {{ $book->author->name }}
                                                    @endif
                                                </td>
                                                <td class="hidden-xs">
                                                    <span> {{ count($book->chapters) }} </span>

                                                </td>
                                                <td class="hidden-xs">
                                                    <span> {{ $book->created_at->format('Y-m-d') }} </span>
                                                </td>
                                                <td>
                                                    <a class="{{ Config::get('button.btn-index') }}"
                                                       href="{{ action('Backend\BooksController@show', $book->id) }}"
                                                       title="{{ trans('general.view') }}">
                                                        {!! Config::get('button.icon-index') !!}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{-- Notice that you can not create Chapter if you don't have permission to Access the book --}}
                                                    <a class="{{ Config::get('button.btn-create') }}"
                                                       title="{{ trans('general.add_chapter') }}"
                                                       href="{{ action('Backend\ChaptersController@create',['book_id' => $book->id]) }}">
                                                        {!! Config::get('button.icon-create') !!}
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    @if(Auth::user()->isAdminSession() || Auth::user()->isEditorSession())
                                                        <a class="{{ ($book->active) ? Config::get('button.btn-active')  : Config::get('button.btn-not-active')}}"
                                                           title="{{ ($book->active) ? trans('general.active') : trans('general.not_active') }}"
                                                           href="{{ action('Backend\BooksController@getChangeActivationBook',[$book->id,$book->author_id,$book->active]) }}">
                                                            @if($book->active == 1)
                                                                {!! Config::get('button.icon-active') !!}
                                                            @else
                                                                {!! Config::get('button.icon-not-active') !!}
                                                            @endif

                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a class="{{ Config::get('button.btn-edit') }}"
                                                       title="{{ trans('general.edit') }}"
                                                       href="{{ action('Backend\BooksController@edit',$book->id) }}">
                                                        {!! Config::get('button.icon-edit') !!}
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    @if(Auth::user()->isAdminSession())
                                                        <button type="button"
                                                                class="{{ Config::get('button.btn-delete') }}"
                                                                id="delete-{{$book->id}}"
                                                                title="{{ trans('general.delete') }}"
                                                                data-toggle="modal"
                                                                data-target="#myModal">
                                                            {!! Config::get('button.icon-delete') !!}
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="{!! Config::get('button.btn-send') !!}"
                                                       href="{{ action('Backend\MessagesController@create',['book_id' => $book->id,'book_serial'=> $book->serial]) }}"
                                                       title="{{ trans('general.send') }}">
                                                        {!! Config::get('button.icon-send') !!}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @include('backend.partials._delete_modal',['action'=> 'Backend\BooksController@destroy'])
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-warning"
                                         role="alert">
                                        <i class="fa fa-2x fa-info-circle fa-fw"></i>
                                        {{ trans('general.no_books_found') }}</div>
                                @endif
                            </div>

                        </div>
                    </div>

                    {{-- Books Favorited --}}
                    <div class="tab-pane" id="step2">
                        <div class="row">
                            <div class="col-xs-12 paddingTop10">
                                @if($booksFavorited->count() > 0)
                                    <table class="table table-striped table-order" id="booksFavorited">
                                        <thead>
                                        <tr>
                                            <th class="hidden-xs">{{ trans('general.serial') }}</th>
                                            <th>{{ trans('general.title') }}</th>
                                            <th>{{ trans('general.author') }}</th>
                                            <th>{{ trans('general.active') }}</th>
                                            <th>{{ trans('general.remove') }}</th>
                                            <th>{{ trans('general.send_message') }}</th>
                                            <th>{{ trans('general.created-at') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($booksFavorited as $book)
                                            <tr>
                                                <td class="hidden-xs">{{ $book->serial }}</td>
                                                <td>
                                                    <a href="{{ action('BookController@show',$book->id) }}">
                                                        {!! $book->title !!}</a>
                                                </td>
                                                <td>
                                                    <span> {{ $book->author->name }} </span>

                                                </td>
                                                <td>
                                                    <span> {{ $book->active }} </span>
                                                </td>
                                                <td class="text-center">
                                                    <a class="{!! Config::get('button.btn-delete')!!}"
                                                       href="{{ action('Backend\BooksController@getRemoveBookFromUserFavoriteList',[Auth::id(),$book->id]) }}">
                                                        {!! Config::get('button.icon-delete') !!}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="{!! Config::get('button.btn-send') !!}"
                                                       href="{{ action('Backend\MessagesController@create',['book_id' => $book->id]) }}"
                                                       title="{{ trans('general.send') }}">
                                                        {!! Config::get('button.icon-send') !!}
                                                    </a>
                                                </td>
                                                <td>
                                                    <span> {{ str_limit($book->created_at,10,'') }} </span>
                                                </td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-warning"
                                         role="alert">{{ trans('messages.info.no_books_found') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{--Abuse Reports --}}
                    @if(Request::user()->isAdmin())
                        <div class="tab-pane" id="step3">
                            <div class="row">
                                <div class="col-xs-12 paddingTop10">
                                    @if($booksReported->count() > 0)
                                        <table class="table table-striped table-order" id="bookReport">
                                            <thead>
                                            <tr>
                                                <th class="hidden-xs">{{ trans('general.id') }}</th>
                                                <th>{{ trans('general.subject') }}</th>
                                                <th>{{ trans('general.author') }}</th>
                                                <th>{{ trans('general.send_message') }}</th>
                                                <th>{{ trans('general.created-at') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($booksReported as $book)
                                                <tr>
                                                    <td class="hidden-xs">{{ $book->serial }}</td>
                                                    <td>
                                                        <a href="{{ action('BookController@show',[$book->book_id]) }}">
                                                            {!! $book->title !!}</a>
                                                    </td>
                                                    <td>
                                                        <span> {{ $book->author->name }} </span>

                                                    </td>

                                                    <td>
                                                        <a class="{!! Config::get('button.btn-send') !!}"
                                                           href="{{ action('Backend\MessagesController@create',['book_id' => $book->id]) }}"
                                                           title="{{ trans('general.send') }}">
                                                            {!! Config::get('button.icon-send') !!}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <span> {{ str_limit($book->created_at,10,'') }} </span>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="alert alert-warning"
                                             role="alert">{{ trans('messages.info.no_books_found') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Previews for Authors  Only --}}
                    {{--Abuse Reports --}}
                    @if(Request::user()->isAuthor())
                        <div class="tab-pane" id="step4">
                            <div class="row">
                                <div class="col-xs-12 paddingTop10">

                                    @if(!is_null($booksPreviews))
                                        <table class="table table-striped table-order" id="bookPreviews">
                                            <thead>
                                            <tr>
                                                <th class="hidden-xs">{{ trans('general.id') }}</th>
                                                <th>{{ trans('general.title') }}</th>
                                                <th>{{ trans('general.author') }}</th>
                                                <th>{{ trans('general.status') }}</th>
                                                <th>{{ trans('general.remove') }}</th>
                                                <th>{{ trans('general.send_message') }}</th>
                                                <th>{{ trans('general.created-at') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($booksPreviews as $preview)
                                                <tr>
                                                    <td class="hidden-xs">{{ $preview->id }}</td>
                                                    <td>
                                                        <a href="{{ action('Backend\PreviewsController@show',[$preview->chapter_id,$preview->preview_start,$preview->preview_end]) }}">
                                                            {!! $preview->title !!}</a>
                                                    </td>
                                                    <td>
                                                        {{ $preview->name }}
                                                    </td>
                                                    <td>
                                                        <span> {{ $preview->status }} </span>
                                                    </td>
                                                    <td>
                                                        <a class="{{ Config::get('button.btn-delete') }}"
                                                           href="{{ action('Backend\PreviewsController@removePreviewfromAuthorList',$preview->preview_id) }}">
                                                            {!! Config::get('button.icon-delete') !!}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="{!! Config::get('button.btn-send') !!}"
                                                           href="{{ action('Backend\MessagesController@create',['book_id' => $preview->book_id,'chapter_id' => $preview->chapter_id]) }}"
                                                           title="{{ trans('general.send') }}">
                                                            {!! Config::get('button.icon-send') !!}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <span> {{ str_limit($preview->created_at,10,'') }} </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="alert alert-warning"
                                             role="alert">{{ trans('messages.info.no_books_found') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <br>
            </div>

            <!-- END CONTENT ITEM -->
        </div>
    </div>
@stop

