@extends('backend.layouts.dashboard')

@section('content')

@section('titlebar')
    <a class="{!! Config::get('button.btn-create')!!}" href="{{ action('Backend\LangCategoriesController@create') }}">
        {!! Config::get('button.icon-create') !!}
    </a>
@endsection
{!! Breadcrumbs::render('categories') !!}

<div class="panel-body">
    <div class="row">
        <div class="col-xs-12 paddingTop10">
            <table class="table table-bordered table-order">
                <thead>
                <tr class="text-center" style="background-color:#E0E0E0;">
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
                            <a href="{{ action('Backend\LangCategoriesController@edit',$category->id) }}"
                               class="{!! Config::get('button.btn-edit') !!}">
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