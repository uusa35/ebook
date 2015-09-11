@extends('backend.layouts.dashboard')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ trans('word.ads') }}
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 paddingTop10">
                    <table class="table table-striped table-order" id="usersTable">
                        <thead>
                        <tr style="background-color:#E0E0E0;">
                            <th class="hidden-xs">&nbsp;</th>
                            <th>{{ trans('word.id') }}</th>
                            <th>{{ trans('word.image') }}</th>
                            <th>{{ trans('word.created-at') }}</th>
                            <th>{{ trans('word.edit') }}</th>
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
                                    <img  class="img-responsive" src="{{ $ad->url  }}" alt="" style="width:10%; height:auto;"/>
                                </td>
                                <td>
                                    <span> {{ $ad->created_at->format('Y-m-d') }} </span>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ action('Backend\AdController@edit',$ad->id) }}"><i class="fa fa-fw fa-sm fa-edit"></i></a>
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
@stop