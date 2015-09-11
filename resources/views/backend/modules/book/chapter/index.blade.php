
<table class="table table-striped table-hover ">
    <thead>
    <tr>
        <th>{{ trans('word.general.id') }}</th>
        <th>{{ trans('word.general.title') }}</th>
        <th>{{ trans('word.general.status') }}</th>
        <th>{{ trans('word.general.edit') }}</th>
        <th>{{ trans('word.general.view') }}</th>
        <th>{{ trans('word.general.submit') }}</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>chapter one</td>
        <td>title of chapter one</td>
        <td>status</td>
        <td>
            <a class="{{ Config::get('button.btn-edit') }}" href="#"><i class="fa fa-edit"></i></a>
        </td>
        <td>
            <a class="{{ Config::get('button.btn-view') }}" href="#"><i class="fa fa-eye"></i></a>
        </td>
        <td>
            <a class="{{ Config::get('button.btn-submit') }}" href="#"><i class="fa fa-send"></i></a>
        </td>
    </tr>
    </tbody>
</table>