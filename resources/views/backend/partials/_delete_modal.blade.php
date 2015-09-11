<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-lg fa-warning"></i> {!! trans('word.general.delete') !!}</h4>
            </div>
            <div class="modal-body">
                <p>{!! trans('word.general.are-u-sure') !!}</p>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                        <div class="col-lg-6">
                            <button type="button" class="btn btn-success" data-dismiss="modal">{!! trans('word.close') !!}</button>
                        </div>
                        <div class="col-lg-6">
                            {!! Form::open(['action' => ['Backend\BooksController@destroy',$book->id],'method'=>'DELETE'],['class'=>'form-horizontal']) !!}
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">{!! trans('word.general.delete') !!}</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->