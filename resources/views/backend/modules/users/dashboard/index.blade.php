@extends('backend.layouts.dashboard')

@section('content')
    {!! Breadcrumbs::render('dashboard') !!}
@section('titlebar')

@stop

<div class="panel-body">
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
