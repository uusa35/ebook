@if(Request::user()->isAuthorSession())
    {{-- If the User just created the book --}}
    @if($chapter->status == 'pending')
        <a class="{!! Config::get('button.btn-drafted') !!}"
           href="{{ action('Backend\ChaptersController@getUpdateChapterStatus',[$chapter->id,'drafted']) }}"
           title="{{ trans('general.go_drafted') }}">
            {!! Config::get('button.icon-drafted') !!}
        </a>
        {{-- if the user just submitted to admin for approval --}}
    @elseif($chapter->status == 'drafted')
        <a class="{!! Config::get('button.btn-published') !!}"
           href="{{ action('Backend\ChaptersController@getUpdateChapterStatus',[$chapter->id,'published']) }}"
           title="{{ trans('general.go_published') }}">
            {!! Config::get('button.icon-published') !!}
        </a>
    @endif

@elseif(Request::user()->isAdminSession() || Request::user()->isEditorSession())
    @if($chapter->status == 'pending')
        <a class="{!! Config::get('button.btn-drafted') !!}"
           href="{{ action('Backend\ChaptersController@getUpdateChapterStatus',[$chapter->id,'drafted']) }}"
           title="{{ trans('general.go_drafted') }}">
            {!! Config::get('button.icon-drafted') !!}
        </a>
        {{-- if the user just submitted to admin for approval --}}
    @elseif($chapter->status == 'drafted')
        <a class="{!! Config::get('button.btn-published') !!}"
           href="{{ action('Backend\ChaptersController@getUpdateChapterStatus',[$chapter->id,'published']) }}"
           title="{{ trans('general.go_published') }}">
            {!! Config::get('button.icon-published') !!}
        </a>
    @elseif($chapter->status == 'published')
        <a class="{!! Config::get('button.btn-declined') !!}"
           href="{{ action('Backend\ChaptersController@getUpdateChapterStatus',[$chapter->id,'declined']) }}"
           title="{{ trans('general.go_pending') }}">
            {!! Config::get('button.icon-pending') !!}
        </a>
        {{-- if the admin approved the book --}}
    @elseif($chapter->status == 'declined')
        <a class="{!! Config::get('button.btn-pending') !!}"
           href="{{ action('Backend\ChaptersController@getUpdateChapterStatus',[$chapter->id,'pending']) }}"
           title="{{ trans('general.pending') }}">
            {!! Config::get('button.icon-pending') !!}
        </a>
    @endif
@endif