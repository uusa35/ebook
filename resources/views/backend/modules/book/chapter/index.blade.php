@if(count($chapters) > 0)
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>{{ trans('word.general.id') }}</th>
            <th>{{ trans('word.general.title') }}</th>
            <th>{{ trans('word.general.status') }}</th>
            <th>{{ trans('word.general.edit') }}</th>
            <th>{{ trans('word.general.view') }}</th>
            <th>{{ trans('word.general.submit') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($chapters as $chapter)
            <tr>

                <td>{{ $chapter->id }}</td>
                <td>{{ $chapter->title }}</td>
                <td>status</td>
                <td>
                    <a class="{{ Config::get('button.btn-edit') }}"
                       href="{{ action('Backend\ChaptersController@edit',$chapter->id) }}"><i
                                class="fa fa-edit"></i></a>
                </td>
                <td>
                    <a class="{{ Config::get('button.btn-view') }}"
                       href="{{ action('Backend\ChaptersController@getPdfFile',[$chapter->id,$chapter->url]) }}"><i
                                class="fa fa-eye"></i></a>
                </td>
                <td>
                    <a class="{{ Config::get('button.btn-submit') }}" href="#"><i class="fa fa-send"></i></a>
                </td>

            </tr>
        @endforeach

        </tbody>
    </table>

@else
    <div class="alert alert-dismissable alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4><i class="fa fa-times-circle fa-md"></i> {{ trans('word.general.alert') }}</h4>

        <p>{{ trans('message.error.no_chapters') }}</p>
    </div>
@endif