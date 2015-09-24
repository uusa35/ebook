@section('scripts')
    @parent
    <script type="text/javascript">
        $(function () {
            $("#chapters").DataTable();
        });
    </script>
@endsection

@if(count($chapters) > 0)
    <table class="table table-striped table-hover " id="chapters">
        <thead>
        <tr>
            <th>{{ trans('general.id') }}</th>
            <th>{{ trans('general.title') }}</th>
            <th>{{ trans('general.status') }}</th>
            <th>{{ trans('general.edit') }}</th>
            <th>{{ trans('general.view') }}</th>
            <th>{{ trans('general.submit') }}</th>
            <th>{{ trans('general.total_pages') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($chapters as $chapter)
            <tr>

                <td>{{ $chapter->id }}</td>
                <td>{{ $chapter->title }}</td>
                <td>
                    @can('change')
                        {{-- If the User just created the book --}}
                        @if($chapter->status == 'pending')
                            <a class="{!! Config::get('button.btn-drafted') !!}" href="" title="go draft">
                                {!! Config::get('button.icon-drafted') !!}
                            </a>
                            {{-- if the user just submitted to admin for approval --}}
                        @elseif($chapter->status == 'drafted')
                            <a class="{!! Config::get('button.btn-published') !!}" href="" title="go draft">
                                {!! Config::get('button.icon-published') !!}
                            </a>
                        {{-- if the admin approved the book --}}
                        @elseif($chapter->status == 'published')
                            <a class="{!! Config::get('button.btn-declined') !!}" href="" title="go declined">
                                {!! Config::get('button.icon-declined') !!}
                            </a>
                        @endif
                    @endcan
                </td>
                <td>
                    <a class="{!! Config::get('button.btn-edit') !!}"
                       href="{{ action('Backend\ChaptersController@edit',['chapter_id' => $chapter->id,'book_id'=>$book->id]) }}">
                        {!! Config::get('button.icon-edit') !!}
                    </a>
                </td>
                <td>
                    <a class="{!! Config::get('button.btn-view') !!}"
                       href="{{ action('Backend\ChaptersController@getPdfFile',[$chapter->id,$chapter->url]) }}">
                        {!! Config::get('button.icon-view') !!}
                    </a>
                </td>
                <td>
                    <a class="{!! Config::get('button.btn-submit') !!}" href="#">
                        {!! Config::get('button.icon-submit') !!}
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
    </div>
@endif