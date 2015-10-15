@extends('backend.layouts.dashboard')

@section('content')
    {!! Breadcrumbs::render('dashboard') !!}
@section('titlebar')

@stop

<div class="panel-body">


    <div class="row">
        @if(!is_null(Cache::get('counters')))
            @foreach(Cache::get('counters') as $counterKey => $counterValue)

                <div class="col-lg-3">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $counterValue }}</h3>

                            <p>{{ $counterValue.' '.$counterKey }} </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-fw fa-{{str_singular(strtolower($counterKey))}}"></i>
                        </div>
                        <a href="{{ URL::to('backend/'.strtolower($counterKey)) }}" class="small-box-footer">More info
                            <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            @endforeach
        @endif


    </div>
    <ol>
        <li>how many users.</li>
        <li>how many favorites.</li>
        <li>how many books.</li>
        <li>how many followers.</li>
        <li>how many views for all related books.</li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ol>

</div>
@endsection
