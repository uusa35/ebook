@extends('backend.layouts.dashboard')

@section('content')

@section('titlebar')
    <div class="col-lg-1 ">
        <a class="{!! Config::get('button.btn-create')!!}" title="{{ trans('general.create')}}" href="{{ action('Backend\FieldCategoriesController@create') }}">
            {!! Config::get('button.icon-create') !!}
        </a>
    </div>
    <div class="col-lg-1 col-lg-offset-1">
        <a class="{!! Config::get('button.btn-index')!!}" itle="{{ trans('general.index')}}" href="{{ action('Backend\LangCategoriesController@index') }}">
            {!! Config::get('button.icon-index') !!}
        </a>
    </div>

@endsection
{!! Breadcrumbs::render('categories') !!}
<div class="panel-body">
    <div class="row">
        <div class="col-xs-12 paddingTop10">
            <table class="table table-bordered table-order table-stripped">
                <thead>
                <tr class="well-material-blue-grey-100" >
                    <th>{{ trans('id') }}</th>
                    <th>{{ trans('general.name_ar') }}</th>
                    <th>{{ trans('general.name_en') }}</th>
                    <th>{{ trans('general.edit') }}</th>
                    <th>{{ trans('general.created_at') }}</th>
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
                                <a href="{{ action('Backend\FieldCategoriesController@edit',$category->id) }}"
                                   title="{{ trans('general.edit') }}" class="{!! Config::get('button.btn-edit') !!}">

                                    {!! Config::get('button.icon-edit') !!}

                                </a>

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

@stop