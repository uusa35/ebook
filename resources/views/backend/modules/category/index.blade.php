@extends('backend.layouts.dashboard')

@section('content')
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3>{{ trans('word.categories') }}</h3>
                        </div>


                        <div class=" col-lg-2 text-center {{ (App::getLocale('lang') === 'ar') ?  'pull-left' : 'pull-right'  }}">
                            @if(in_array('field',Request::segments()))
                                <a class="btn btn-danger" href="{{ action('Backend\FieldCategoryController@create') }}"><i
                                            class="fa fa-fw fa-intend"></i>{{ trans('word.create-category') }}</a>
                            @else
                                <a class="btn btn-danger" href="{{ action('Backend\LangCategoryController@create') }}"><i
                                            class="fa fa-fw fa-intend"></i>{{ trans('word.create-category') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 paddingTop10">
                            <table class="table table-bordered table-order">
                                <thead>
                                <tr class="text-center" style="background-color:#E0E0E0;">
                                    <th>{{ trans('id') }}</th>
                                    <th>{{ trans('word.name-ar') }}</th>
                                    <th>{{ trans('word.name-en') }}</th>
                                    <th>{{ trans('word.edit') }}</th>
                                    <th>{{ trans('word.created-at') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            {!! $category->id !!}
                                        </td>
                                        <td>
                                            <span> {{ $category->name_ar }} </span>

                                        </td>
                                        <td>
                                            <span> {{ $category->name_en }} </span>
                                        </td>
                                        <td class="text-center">
                                            @if(in_array('field',Request::segments()))
                                                <a href="{{ action('Backend\FieldCategoryController@edit',$category->id) }}"
                                                   class="text-center btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil fa-2x"></i>
                                                </a>
                                            @else
                                                <a href="{{ action('Backend\LangCategoryController@edit',$category->id) }}"
                                                   class="text-center btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil fa-2x"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <span> {{ $category->created_at->format('Y-m-d') }} </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

@stop