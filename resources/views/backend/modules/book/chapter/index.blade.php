@section('scripts')
    @parent
    <script type="text/javascript">
        $(function () {
            $('#chapters_all').DataTable({
                "order": [[0, "asc"]]
            });
            $('#chapters_published').DataTable({
                "order": [[0, "asc"]]
            });
            $('#chapters_drafted').DataTable({
                "order": [[0, "asc"]]
            });
            $('#chapters_pending').DataTable({
                "order": [[0, "asc"]]
            });
            $('#chapters_declined').DataTable({
                "order": [[0, "asc"]]
            });

        });
    </script>
@endsection

@if(!is_null($allChapters))

    <div class="row">
        <div class="col-xs-12">

            <!-- START CONTENT ITEM -->
            <ul class="nav nav-tabs btn-material-blue-grey-400">
                <li id="tab-1" class="" href="#step1"><a href="#step1" data-toggle="tab"><i
                                class="fa fa-aw fa-book"></i>&nbsp;{{ trans('general.chapters') }} </a></li>

                <li id="tab-2"><a href="#step2" data-toggle="tab"><i
                                class="fa fa-aw fa-exclamation-triangle"></i>&nbsp;{{ trans('general.published') }}
                    </a></li>
                <li id="tab-3"><a href="#step3" data-toggle="tab"><i
                                class="fa fa-aw fa-exclamation-triangle"></i>&nbsp;{{ trans('general.pending') }}
                    </a></li>
                <li id="tab-4"><a href="#step4" data-toggle="tab"><i
                                class="fa fa-aw fa-exclamation-triangle"></i>&nbsp;{{ trans('general.drafted') }}
                    </a></li>
                <li id="tab-5"><a href="#step5" data-toggle="tab"><i
                                class="fa fa-aw fa-exclamation-triangle"></i>&nbsp;{{ trans('general.declined') }}
                    </a></li>
            </ul>

            <div class="tab-content">

                {{--All Chapters--}}
                <div class="tab-pane active" id="step1">
                    <div class="row">
                        <div class="col-xs-12 paddingTop10">
                            <table class="table table-striped table-hover table-condensed" id="chapters_all">
                                <thead>
                                <tr>
                                    <th class="hidden-xs">{{ trans('general.id') }}</th>
                                    <th class="hidden-xs">{{ trans('general.title') }}</th>
                                    <th>{{ trans('general.status') }}</th>
                                    <th>{{ trans('general.change_status') }}</th>
                                    <th>{{ trans('general.edit') }}</th>
                                    <th>{{ trans('general.view') }}</th>
                                    <th>{{ trans('general.create_preview') }}</th>
                                    <th>{{ trans('general.all_previews') }}</th>
                                    <th>{{ trans('general.send_message') }}</th>
                                    <th class="hidden-xs">{{ trans('general.total_pages') }}</th>
                                </tr>
                                </thead>
                                @foreach($allChapters as $chapter)
                                    <tbody>

                                    <tr>
                                        <td class="hidden-xs">{{ $chapter->id }}</td>
                                        <td class="hidden-xs">{{ $chapter->title }}</td>
                                        <td>{{ $chapter->status }}</td>
                                        <td>
                                            @include('backend.partials.buttons._chapter_change_status_btn')
                                        </td>
                                        <td>
                                            @include('backend.partials.buttons._chapter_edit_btn')
                                        </td>
                                        <td>
                                            <a class="{!! Config::get('button.btn-view') !!}"
                                               title="{{ trans('general.view_pdf') }}"
                                               href="{{ action('Backend\ChaptersController@getPdfFile',[$chapter->id,$chapter->url]) }}">
                                                {!! Config::get('button.icon-view') !!}
                                            </a>
                                        </td>
                                        <td>
                                            <a class="{!! Config::get('button.btn-create') !!}"
                                               title="{{ trans('general.create_preview') }}"
                                               href="{{ action('Backend\PreviewsController@create',$chapter->id) }}">
                                                {!! Config::get('button.icon-create') !!}
                                            </a>
                                        </td>
                                        <td>
                                            <a class="{!! Config::get('button.btn-index') !!}"
                                               title="{{ trans('general.all_previews') }}"
                                               href="{{ action('Backend\PreviewsController@index',$chapter->id) }}">
                                                {!! Config::get('button.icon-index') !!}
                                            </a>
                                        </td>
                                        <td>
                                            <a class="{!! Config::get('button.btn-send') !!}"
                                               href="{{ action('Backend\MessagesController@create',['book_id' => $chapter->book->author_id, 'chapter_id' => $chapter->id]) }}"
                                               title="{{ trans('general.send') }}">
                                                {!! Config::get('button.icon-send') !!}
                                            </a>
                                        </td>
                                        <td class="hidden-xs">
                                            {{ $chapter->total_pages }}
                                        </td>

                                    </tr>

                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Published Chapters --}}
                <div class="tab-pane" id="step2">
                    <div class="row">
                        <div class="col-xs-12 paddingTop10">
                            @if(!is_null($publishedChapters))
                                <table class="table table-striped table-hover " id="chapters_published">
                                    <thead>
                                    <tr>
                                        <th class="hidden-xs">{{ trans('general.id') }}</th>
                                        <th class="hidden-xs">{{ trans('general.title') }}</th>
                                        <th>{{ trans('general.status') }}</th>
                                        <th>{{ trans('general.change_status') }}</th>
                                        <th>{{ trans('general.edit') }}</th>
                                        <th>{{ trans('general.view') }}</th>
                                        <th>{{ trans('general.create_preview') }}</th>
                                        <th>{{ trans('general.all_previews') }}</th>
                                        <th>{{ trans('general.send_message') }}</th>
                                        <th class="hidden-xs">{{ trans('general.total_pages') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($publishedChapters as $chapter)
                                        <tr>

                                            <td class="hidden-xs">{{ $chapter->id }}</td>
                                            <td class="hidden-xs">{{ $chapter->title }}</td>
                                            <td>{{ $chapter->status }}</td>
                                            <td>
                                                @include('backend.partials.buttons._chapter_change_status_btn')
                                            </td>
                                            <td>
                                                @include('backend.partials.buttons._chapter_edit_btn')
                                            </td>
                                            <td>
                                                <a class="{!! Config::get('button.btn-view') !!}"
                                                   title="{{ trans('general.view_pdf') }}"
                                                   href="{{ action('Backend\ChaptersController@getPdfFile',[$chapter->id,$chapter->url]) }}">
                                                    {!! Config::get('button.icon-view') !!}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="{!! Config::get('button.btn-create') !!}"
                                                   title="{{ trans('general.create_preview') }}"
                                                   href="{{ action('Backend\PreviewsController@create',[$chapter->id]) }}">
                                                    {!! Config::get('button.icon-create') !!}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="{!! Config::get('button.btn-index') !!}"
                                                   title="{{ trans('general.all_previews') }}"
                                                   href="{{ action('Backend\PreviewsController@index',[$chapter->id]) }}">
                                                    {!! Config::get('button.icon-index') !!}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="{!! Config::get('button.btn-send') !!}"
                                                   href="{{ action('Backend\MessagesController@create',['book_id' => $chapter->book_id, 'chapter_id' => $chapter->id]) }}"
                                                   title="{{ trans('general.send') }}">
                                                    {!! Config::get('button.icon-send') !!}
                                                </a>
                                            </td>
                                            <td class="hidden-xs">
                                                {{ $chapter->total_pages }}
                                            </td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-dismissable alert-info">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <h4><i class="fa fa-times-circle fa-md"></i> {{ trans('general.alert') }}</h4>

                                    <p>{{ trans('message.error.no_chapters') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                {{-- Pending Chapters --}}
                <div class="tab-pane " id="step3">
                    <div class="row">
                        <div class="col-xs-12 paddingTop10">
                            @if(!is_null($pendingChapters))
                                <table class="table table-striped table-hover " id="chapters_pending">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('general.id') }}</th>
                                        <th>{{ trans('general.title') }}</th>
                                        <th>{{ trans('general.status') }}</th>
                                        <th>{{ trans('general.change_status') }}</th>
                                        <th>{{ trans('general.edit') }}</th>
                                        <th>{{ trans('general.view') }}</th>
                                        <th>{{ trans('general.create_preview') }}</th>
                                        <th>{{ trans('general.all_previews') }}</th>
                                        <th>{{ trans('general.send_message') }}</th>
                                        <th>{{ trans('general.total_pages') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pendingChapters as $chapter)
                                        <tr>
                                            <td>{{ $chapter->id }}</td>
                                            <td>{{ $chapter->title }}</td>
                                            <td> {{ $chapter->status }}</td>
                                            <td>
                                                @include('backend.partials.buttons._chapter_change_status_btn')
                                            </td>
                                            <td>
                                                @include('backend.partials.buttons._chapter_edit_btn')

                                            </td>
                                            <td>
                                                <a class="{!! Config::get('button.btn-view') !!}"
                                                   title="{{ trans('general.view_pdf') }}"
                                                   href="{{ action('Backend\ChaptersController@getPdfFile',[$chapter->id,$chapter->url]) }}">
                                                    {!! Config::get('button.icon-view') !!}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="{!! Config::get('button.btn-create') !!}"
                                                   title="{{ trans('general.create_preview') }}"
                                                   href="{{ action('Backend\PreviewsController@create',[$chapter->id]) }}">
                                                    {!! Config::get('button.icon-create') !!}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="{!! Config::get('button.btn-view') !!}"
                                                   title="{{ trans('general.all_previews') }}"
                                                   href="{{ action('Backend\PreviewsController@index',[$chapter->id]) }}">
                                                    {!! Config::get('button.icon-view') !!}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="{!! Config::get('button.btn-send') !!}"
                                                   href="{{ action('Backend\MessagesController@create',['book_id' => $chapter->book_id, 'chapter_id' => $chapter->id]) }}"
                                                   title="{{ trans('general.send') }}">
                                                    {!! Config::get('button.icon-send') !!}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $chapter->total_pages }}
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-dismissable alert-info">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <h4><i class="fa fa-times-circle fa-md"></i> {{ trans('general.alert') }}</h4>

                                    <p>{{ trans('message.error.no_chapters') }}</p>
                                    @endif
                                </div>
                        </div>
                    </div>


                    {{-- Drafted Chapters --}}
                    <div class="tab-pane " id="step4">
                        <div class="row">
                            <div class="col-xs-12 paddingTop10">
                                @if(!is_null($draftedChapters))
                                    <table class="table table-striped table-hover " id="chapters_drafted">
                                        <thead>
                                        <tr>
                                            <th>{{ trans('general.id') }}</th>
                                            <th>{{ trans('general.title') }}</th>
                                            <th>{{ trans('general.status') }}</th>
                                            <th>{{ trans('general.change_status') }}</th>
                                            <th>{{ trans('general.edit') }}</th>
                                            <th>{{ trans('general.view') }}</th>
                                            <th>{{ trans('general.create_preview') }}</th>
                                            <th>{{ trans('general.all_previews') }}</th>
                                            <th>{{ trans('general.send_message') }}</th>
                                            <th>{{ trans('general.total_pages') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($draftedChapters as $chapter)
                                            <tr>

                                                <td>{{ $chapter->id }}</td>
                                                <td>{{ $chapter->title }}</td>
                                                <td>{{ $chapter->status }}</td>
                                                <td>
                                                    @include('backend.partials.buttons._chapter_change_status_btn')
                                                </td>
                                                <td>
                                                    @include('backend.partials.buttons._chapter_edit_btn')
                                                </td>
                                                <td>
                                                    <a class="{!! Config::get('button.btn-view') !!}"
                                                       title="{{ trans('general.view_pdf') }}"
                                                       href="{{ action('Backend\ChaptersController@getPdfFile',[$chapter->id,$chapter->url]) }}">
                                                        {!! Config::get('button.icon-view') !!}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="{!! Config::get('button.btn-create') !!}"
                                                       title="{{ trans('general.create_preview') }}"
                                                       href="{{ action('Backend\PreviewsController@create',[$chapter->id]) }}">
                                                        {!! Config::get('button.icon-create') !!}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="{!! Config::get('button.btn-view') !!}"
                                                       title="{{ trans('general.all_previews') }}"
                                                       href="{{ action('Backend\PreviewsController@index',[$chapter->id]) }}">
                                                        {!! Config::get('button.icon-view') !!}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="{!! Config::get('button.btn-send') !!}"
                                                       href="{{ action('Backend\MessagesController@create',['book_id' => $chapter->book_id, 'chapter_id' => $chapter->id]) }}"
                                                       title="{{ trans('general.send') }}">
                                                        {!! Config::get('button.icon-send') !!}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $chapter->total_pages }}
                                                </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-dismissable alert-info">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <h4><i class="fa fa-times-circle fa-md"></i> {{ trans('general.alert') }}</h4>

                                        <p>{{ trans('message.error.no_chapters') }}</p>
                                        @endif
                                    </div>
                            </div>
                        </div>


                        {{-- Declined Chapters --}}
                        <div class="tab-pane " id="step5">
                            <div class="row">
                                <div class="col-xs-12 paddingTop10">
                                    @if(!is_null($declinedChapters))
                                        <table class="table table-striped table-hover " id="chapters_declined">
                                            <thead>
                                            <tr>
                                                <th>{{ trans('general.id') }}</th>
                                                <th>{{ trans('general.title') }}</th>
                                                <th>{{ trans('general.status') }}</th>
                                                <th>{{ trans('general.change_status') }}</th>
                                                <th>{{ trans('general.edit') }}</th>
                                                <th>{{ trans('general.view') }}</th>
                                                <th>{{ trans('general.create_preview') }}</th>
                                                <th>{{ trans('general.all_previews') }}</th>
                                                <th>{{ trans('general.send_message') }}</th>
                                                <th>{{ trans('general.total_pages') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($declinedChapters as $chapter)
                                                <tr>

                                                    <td>{{ $chapter->id }}</td>
                                                    <td>{{ $chapter->title }}</td>
                                                    <td> {{ $chapter->status }}</td>
                                                    <td>
                                                        @include('backend.partials.buttons._chapter_change_status_btn')
                                                    </td>
                                                    <td>
                                                        @include('backend.partials.buttons._chapter_edit_btn')
                                                    </td>
                                                    <td>
                                                        <a class="{!! Config::get('button.btn-view') !!}"
                                                           title="{{ trans('general.view_pdf') }}"
                                                           href="{{ action('Backend\ChaptersController@getPdfFile',[$chapter->id,$chapter->url]) }}">
                                                            {!! Config::get('button.icon-view') !!}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="{!! Config::get('button.btn-create') !!}"
                                                           title="{{ trans('general.create_preview') }}"
                                                           href="{{ action('Backend\PreviewsController@create',[$chapter->id]) }}">
                                                            {!! Config::get('button.icon-create') !!}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="{!! Config::get('button.btn-view') !!}"
                                                           title="{{ trans('general.all_previews') }}"
                                                           href="{{ action('Backend\PreviewsController@index',[$chapter->id]) }}">
                                                            {!! Config::get('button.icon-view') !!}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a class="{!! Config::get('button.btn-send') !!}"
                                                           href="{{ action('Backend\MessagesController@create',['book_id' => $chapter->book_id, 'chapter_id' => $chapter->id]) }}"
                                                           title="{{ trans('general.send') }}">
                                                            {!! Config::get('button.icon-send') !!}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{ $chapter->total_pages }}
                                                    </td>

                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    @else
                                        <div class="alert alert-dismissable alert-info">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <h4><i class="fa fa-times-circle fa-md"></i> {{ trans('general.alert') }}
                                            </h4>

                                            <p>{{ trans('message.error.no_chapters') }}</p>
                                            @endif
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @else
                    <div class="alert alert-dismissable alert-info">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <h4><i class="fa fa-times-circle fa-md"></i> {{ trans('general.alert') }}</h4>

                        <p>{{ trans('message.error.no_chapters') }}</p>
                    </div>

            </div>
@endif