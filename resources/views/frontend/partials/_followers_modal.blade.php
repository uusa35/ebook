<div class="modal" id="followers">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">


                <hr/>
                <h4>{!! Config::get('button.icon-info') !!} | {{ trans('general.followers') }}</h4>
                <hr/>


                @foreach($followers as $follower)
                    <a href="{{ action('UserController@show',$follower->user->id) }}" class="btn btn-material-cyan-A700">
                        {!! Config::get('button.icon-user') !!}
                        {{ $follower->user->name }}
                    </a>
                @endforeach

                <hr/>

            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">{!! trans('close') !!}
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