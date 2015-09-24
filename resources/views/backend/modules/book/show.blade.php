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
    @can('create')
    <a class="{{ Config::get('button.btn-create') }}" href="{{ action('Backend\ChaptersController@create',['book_id'=>$book->id]) }}"><i
                class="fa fa-plus"></i></a>
    @endcan
@endsection

<div class="panel-body">
    <div class="row">
        <div class="col-lg-3">
            <div class=" box box-widget widget-user shadow-z-1">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-white"
                     style="background: url(' {{ asset('images/uploads/cover/large/'.$book->cover) }}') center center no-repeat; background-size: 100%; ">
                </div>
                <div class="box-footer">
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                                <span class="description-text">
                                    {{ $book->title }}
                                    <p>
                                        {{ $book->description }}
                                    </p>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        <div class="col-lg-9">
            @include('backend.modules.book.chapter.index')
        </div>
    </div>
</div>
@stop