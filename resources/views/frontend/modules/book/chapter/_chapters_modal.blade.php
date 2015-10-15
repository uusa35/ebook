<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    {!! Config::get('button.icon-view') !!} |  {!! trans('general.view') !!}
                    - {{ $book->title }}</h4>
            </div>
            <div class="modal-body">

                <table class="table table-striped table-hover " id="chapters1">
                    <thead>
                    <tr>

                        <th>{{ trans('general.title') }}</th>
                        <th>{{ trans('general.total_pages') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($book->chapters as $chapter)
                        <tr>
                            <td>
                                <a class=""
                                   href="{{ action('Backend\ChaptersController@getPdfFile',[$chapter->id,$chapter->url]) }}">
                                    {{ $chapter->title }}
                                </a>
                            </td>
                            <td>
                                {{ $chapter->total_pages }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-success" data-dismiss="modal">{!! trans('close')
                                    !!}
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6">

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->