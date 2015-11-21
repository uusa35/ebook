@extends('backend.layouts.dashboard')


@section('slider')
    {{--@include('frontend.partials.slider')--}}
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="addthis_native_toolbox"></div>
        </div>
    </div>
@stop

@section('content')
    {!! Breadcrumbs::render('book_show') !!}

@section('titlebar')
    @can('create','book_create')
    <a class="{{ Config::get('button.btn-create') }}"
       href="{{ action('Backend\ChaptersController@create',['book_id'=>$book->id]) }}"
       title="{{ trans('general.add') }}">
        {!! Config::get('button.icon-create') !!}</a>
    @endcan
@endsection

<div class="panel-body">
    <div class="row">
        <div class="col-lg-12">
            @include('backend.modules.book.chapter.index')
        </div>
    </div>
</div>
@stop