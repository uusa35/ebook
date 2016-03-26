@extends('backend.layouts.dashboard')

@section('content')
    {!! Breadcrumbs::render('ads') !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            {{ trans('general.ads') }}
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 paddingTop10">
                    <table class="table table-striped table-order" id="usersTable">
                        <thead>
                        <tr style="background-color:#E0E0E0;">
                            <th class="hidden-xs">&nbsp;</th>
                            <th>{{ trans('general.id') }}</th>
                            <th>{{ trans('general.image') }}</th>
                            <th>{{ trans('general.url') }}</th>
                            <th>{{ trans('general.created_at') }}</th>
                            <th>{{ trans('general.edit') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allAdsStored as $ad)
                            <tr>
                                <td class="hidden-xs">{{ $ad->id }}</td>
                                <td>
                                    <span>{{ $ad->name }}</span>
                                </td>
                                <td>
                                    <img  class="img-responsive" src="{{ asset('images/uploads/ads/large/'.$ad->ads) }}" alt="" style="width:50%; height:auto;"/>
                                </td>
                                <td>
                                    {{ $ad->url }}
                                </td>
                                <td>
                                    <span> {{ $ad->created_at->format('Y-m-d') }} </span>
                                </td>
                                <td>
                                    @if(Request::user()->isAdminSession())
                                    <a class="{{ Config::get('button.btn-edit') }}" href="{{ action('Backend\AdsController@edit',$ad->id) }}">
                                        {!! Config::get('button.icon-edit') !!}
                                        </a>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

@stop