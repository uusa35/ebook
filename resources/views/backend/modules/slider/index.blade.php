@extends('backend.layouts.dashboard')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ trans('general.slider') }}
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 paddingTop10">
                    <table class="table table-striped table-order" id="usersTable">
                        <thead>
                        <tr style="background-color:#E0E0E0;">
                            <th class="hidden-xs">&nbsp;</th>
                            <th>{{ trans('general.slider') }}</th>
                            <th>{{ trans('general.image') }}</th>
                            <th>{{ trans('general.created_at') }}</th>
                            <th>{{ trans('general.edit') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allSlides as $slide)
                            <tr>
                                <td class="hidden-xs">{{ $slide->id }}</td>
                                <td>
                                    <span>{{ $slide->caption }}</span>
                                </td>
                                <td>
                                    <img  class="img-responsive" src="{{ asset('images/uploads/slide/thumbnail/'.$slide->slide) }}" alt="" style="width:10%; height:auto;"/>
                                </td>
                                <td>
                                    <span> {{ $slide->created_at->format('Y-m-d') }} </span>
                                </td>
                                <td>
                                    @can('edit')
                                    <a class="{{ Config::get('button.btn-edit') }}" href="{{ action('Backend\SlidersController@edit',$slide->id) }}">
                                        {!! Config::get('button.icon-edit') !!}
                                        </a>
                                    @endcan
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