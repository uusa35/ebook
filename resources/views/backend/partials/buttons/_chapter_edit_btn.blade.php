<a class="{!! Config::get('button.btn-edit') !!}"
   title="{{ trans('general.edit') }}"
   href="{{ action('Backend\ChaptersController@edit',['chapter_id' => $chapter->id,'book_id'=>$book->id]) }}">
    {!! Config::get('button.icon-edit') !!}
</a>
