@if(Request::user()->isAdmin() ||  Request::user()->isEditor())
    <a class="{!! Config::get('button.btn-edit') !!}"
       title="{{ trans('general.edit') }}"
       href="{{ action('Backend\ChaptersController@edit',['chapter_id' => $chapter->id,'book_id'=>$book->id]) }}">
        {!! Config::get('button.icon-edit') !!}
    </a>
@else
    @if($chapter->status == 'pending')
        <a class="{!! Config::get('button.btn-edit') !!}"
           title="{{ trans('general.edit') }}"
           href="{{ action('Backend\ChaptersController@edit',['chapter_id' => $chapter->id,'book_id'=>$book->id]) }}">
            {!! Config::get('button.icon-edit') !!}
        </a>
    @else
        <a href=""
           class="{{ Config::get('button.btn-edit') }} disabled">{!! Config::get('button.icon-edit') !!}</a>
    @endif
@endif