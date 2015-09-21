@extends('backend.layouts.dashboard')

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function () {
            $('#booksTable').DataTable({
                "order": [[0, "desc"]]
            });
        });
    </script>
@stop

@section('content')
    {!! Breadcrumbs::render('books') !!}

    <div class="panel-body">

        @section('titlebar')
            @can('create')
            <a class="{{ Config::get('button.btn-create') }}" href="{{ action('Backend\BooksController@create') }}"
               title="{{ trans('general.book_create') }}">
                {!! Config::get('button.icon-create')!!}
            </a>
            @endcan
        @stop

        <div class="row">
            <div class="col-xs-12">

                <!-- START CONTENT ITEM -->
                <ul class="nav nav-tabs btn-material-blue-grey-400">
                    <li id="tab-1" class="" href="#step1"><a href="#step1" data-toggle="tab"><i
                                    class="fa fa-aw fa-book"></i>&nbsp;{{ trans('general.volumes') }} </a></li>
                    @if(Cache::get('Module.Admin'))
                        <li id="tab-2"><a href="#step2" data-toggle="tab"><i
                                        class="fa fa-aw fa-exclamation-triangle"></i>&nbsp;{{ trans('general.report') }}
                            </a></li>
                    @endif
                </ul>

                {{--All Books--}}

                <div class="tab-content">

                    <div class="tab-pane active" id="step1">
                        <div class="row">
                            <div class="col-xs-12 paddingTop10">
                                @if($books->count() > 0)
                                    <table class="table table-striped table-order" id="booksTable">
                                        <thead>
                                        <tr style="background-color:#E0E0E0;">
                                            <th class="hidden-xs">{{ trans('general.id') }}</th>
                                            <th>{{ trans('general.title') }}</th>
                                            <th>{{ trans('general.chapters') }}</th>
                                            <th>{{ trans('general.free') }}</th>
                                            <th>{{ trans('general.created_at') }}</th>
                                            <th>{{ trans('general.view') }}</th>
                                            <th>{{ trans('general.add') }}</th>
                                            <th>{{ trans('general.active') }}</th>
                                            <th>{{ trans('general.edit') }}</th>
                                            @if(Cache::get('Module.Admin'))
                                                <th>{{ trans('general.delete') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($books as $book)
                                            <tr>
                                                <td class="hidden-xs">{{ $book->id }}</td>
                                                <td>
                                                    <a href="{{ action('Backend\BooksController@show', $book->id) }}">
                                                        {!!
                                                        $book->title
                                                        !!} </a>
                                                </td>
                                                <td>
                                                    <span> {{ ($book->meta) ? $book->meta->total_pages : 'N/A' }} </span>

                                                </td>
                                                <td>
                                                    <span> {{ ($book->free) ? 'free' : 'paid' }} </span>
                                                </td>
                                                <td>
                                                    <span> {{ $book->created_at->format('Y-m-d') }} </span>
                                                </td>
                                                <td>
                                                    <a class="{{ Config::get('button.btn-view') }}"
                                                       href="{{ action('Backend\BooksController@show', $book->id) }}"
                                                       title="{{ trans('general.view') }}">
                                                        {!! Config::get('button.icon-view') !!}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{-- Notice that you can not create Chapter if you don't have permission to Access the book --}}
                                                    @can('edit')
                                                    <a class="{{ Config::get('button.btn-create') }}"
                                                       title="{{ trans('general.add_chapter') }}"
                                                       href="{{ action('Backend\ChaptersController@create',['book_id' => $book->id]) }}">
                                                        {!! Config::get('button.icon-create') !!}
                                                    </a>
                                                    @endcan
                                                </td>
                                                <td class="text-center">
                                                    @can('change')
                                                    <a class="{{ ($book->active) ? Config::get('button.btn-active')  : Config::get('button.btn-not-active')}}"
                                                       title="{{ ($book->active) ? trans('general.active') : trans('general.not_active') }}"
                                                       href="{{ action('Backend\BooksController@getChangeActivationBook',[$book->id,$book->user->id,$book->active]) }}">
                                                        {!! ($book->active) ? Config::get('button.icon-not-active') :
                                                        Config::get('icon-active') !!}
                                                    </a>
                                                    @endcan
                                                </td>
                                                <td class="text-center">
                                                    @can('edit')
                                                    <a class="{{ Config::get('button.btn-edit') }}"
                                                       title="{{ trans('general.edit') }}"
                                                       href="{{ action('Backend\BooksController@edit',$book->id) }}">
                                                        {!! Config::get('button.icon-edit') !!}
                                                    </a>
                                                    @endcan
                                                </td>
                                                <td class="text-center">
                                                    @can('delete')
                                                    <button type="button" class="{{ Config::get('button.btn-delete') }}"
                                                            title="{{ trans('general.delete') }}"
                                                            data-toggle="modal"
                                                            data-target="#myModal">
                                                        {!! Config::get('button.icon-delete') !!}
                                                    </button>
                                                    @include('backend.partials._delete_modal')
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
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

                    {{--Abuse Reports --}}
                    @if(Cache::get('Module.Admin'))
                        <div class="tab-pane" id="step2">
                            <div class="row">
                                <div class="col-xs-12 paddingTop10">
                                    @if($booksReported->count() > 0)
                                        <table class="table table-striped table-order">
                                            <thead>
                                            <tr>
                                                <th class="hidden-xs">{{ trans('general.id') }}</th>
                                                <th>{{ trans('general.subject') }}</th>
                                                <th>{{ trans('general.sender') }}</th>
                                                <th>{{ trans('general.status') }}</th>
                                                <th>{{ trans('general.remove') }}</th>
                                                <th>{{ trans('general.created-at') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($booksReported as $book)
                                                <tr>
                                                    <td class="hidden-xs">{{ $book->book_id }}</td>
                                                    <td>
                                                        <a href="{{ action('BookController@show',[$book->book_id]) }}">
                                                            {!! $book->title_en !!}</a>
                                                    </td>
                                                    <td>
                                                        <span> {{ $book->name_ar }} </span>

                                                    </td>
                                                    <td>
                                                        <span> {{ $book->status }} </span>
                                                    </td>
                                                    <td class="text-center">
                                                        remove
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

                </div>

                <br>

            </div>


            <!-- END CONTENT ITEM -->

        </div>
    </div>


@stop

