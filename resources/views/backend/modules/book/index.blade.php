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
            <a class="{{ Config::get('button.btn-create') }}" href="{{ action('Backend\BooksController@create') }}"><i class="fa fa-plus"></i></a>
            @stop

        <div class="row">
            <div class="col-xs-12">

                <!-- START CONTENT ITEM -->
                <ul class="nav nav-tabs btn-material-blue-grey-400">
                    <li id="tab-1" class="" href="#step1"><a href="#step1" data-toggle="tab"><i
                                    class="fa fa-aw fa-book"></i>&nbsp;{{ trans('word.general.volumes') }} </a></li>
                    @if(Cache::get('Module.Admin'))
                        <li id="tab-2"><a href="#step2" data-toggle="tab"><i
                                        class="fa fa-aw fa-exclamation-triangle"></i>&nbsp;{{ trans('word.general.report') }}
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
                                            <th class="hidden-xs">{{ trans('word.general.id') }}</th>
                                            <th>{{ trans('word.general.title') }}</th>
                                            <th>{{ trans('word.general.total-pages') }}</th>
                                            <th>{{ trans('word.general.free') }}</th>
                                            <th>{{ trans('word.general.created-at') }}</th>
                                            <th>{{ trans('word.general.view') }}</th>
                                            <th>{{ trans('word.general.add') }}</th>
                                            <th>{{ trans('word.general.active') }}</th>
                                            <th>{{ trans('word.general.edit') }}</th>
                                            @if(Cache::get('Module.Admin'))
                                                <th>{{ trans('word.general.delete') }}</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($books as $book)
                                            <tr>
                                                <td class="hidden-xs">{{ $book->id }}</td>
                                                <td>
                                                    <a href="{{ action('Backend\BooksController@show', $book->id) }}"> {!!
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
                                                    <a class="{{ Config::get('button.btn-view') }}" href="{{ action('Backend\BooksController@show', $book->id) }}"><i class="fa fa-xs fa-eye"></i></a>
                                                </td>
                                                <td>
                                                    <a class="{{ Config::get('button.btn-create') }}" href="{{ action('Backend\ChaptersController@create',['book_id' => $book->id]) }}" data-toggle="tooltip"  title="Add Chapter"><i class="fa fa-xs fa-plus"></i></a>
                                                </td>
                                                <td class="text-center">
                                                    <a class="{{ ($book->active) ? Config::get('button.btn-active')  : Config::get('button.btn-not-active')}}" href="{{ action('Backend\BooksController@getChangeActivationBook',[$book->id,$book->user->id,$book->active]) }}">
                                                        <i class="fa fa-xs {{ ($book->active) ? 'fa-times' : 'fa-check' }}"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a class="{{ Config::get('button.btn-edit') }}" href="{{ action('Backend\BooksController@edit',$book->id) }}"><i class="fa fa-edit"></i></a>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="{{ Config::get('button.btn-delete') }}" data-toggle="modal"
                                                            data-target="#myModal" href="">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                    @include('backend.partials._delete_modal')
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                @else
                                    <div class="alert alert-warning"
                                         role="alert">
                                        <i class="fa fa-2x fa-info-circle fa-fw"></i>
                                        {{ trans('word.general.no-books-found') }}</div>
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
                                                <th class="hidden-xs">{{ trans('word.general.id') }}</th>
                                                <th>{{ trans('word.general.subject') }}</th>
                                                <th>{{ trans('word.general.sender') }}</th>
                                                <th>{{ trans('word.general.status') }}</th>
                                                <th>{{ trans('word.general.remove') }}</th>
                                                <th>{{ trans('word.general.created-at') }}</th>
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
                                             role="alert">{{ trans('word.general.no-books-found') }}</div>
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

