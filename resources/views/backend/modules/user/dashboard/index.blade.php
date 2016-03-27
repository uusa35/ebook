@extends('backend.layouts.dashboard')

@section('content')
    {!! Breadcrumbs::render('dashboard') !!}
@section('titlebar')

@stop

<div class="panel-body">


    <div class="row">
        @if(!is_null(Cache::get('counters.'.Auth::id())))
            @foreach(Cache::get('counters.'.Auth::id()) as $counterKey => $counterValue)
                <div class="col-lg-3">
                    <!-- small box -->
                    <div class="small-box well-material-blue-grey-A200" style="margin: 10px;">
                        <div class="inner">
                            <h3>{{ $counterValue }}</h3>

                            <p>{{ $counterValue.' '.$counterKey }} </p>
                        </div>
                        <div class="icon" style="right: 25px; top: 4px;">
                            {{--<i class="fa fa-fw fa-{{str_singular(strtolower($counterKey))}}"></i>--}}
                            {!! Config::get('button.icon-'.str_singular(strtolower($counterKey))) !!}
                        </div>
                        <a href="{{ URL::to('backend/'.strtolower($counterKey)) }}" class="small-box-footer">More info
                            <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endforeach
        @endif


    </div>

</div>
@endsection
