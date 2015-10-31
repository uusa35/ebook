<div class="modal" id="reportAbuse">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

                {{-- Send a message for abouse Report--}}
                <div class="panel-body">
                    <div class="col-lg-12 ">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h1>{{ trans('general.create-message') }}</h1>
                            </div>
                            <div class="panel-body">


                                {!! Form::open(['action' => 'Backend\MessagesController@store']) !!}
                                <div class="col-md-12">
                                    <!-- Subject Form Input -->
                                    <div class="form-group">
                                        {!! Form::label('subject', trans('general.subject'), ['class' => 'control-label']) !!}
                                        {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                                    </div>

                                    <!-- Message Form Input -->
                                    <div class="form-group">
                                        {!! Form::label('message', trans('general.content'), ['class' => 'control-label']) !!}
                                        {!! Form::textarea('message', null, ['class' => 'form-control','placeholder' => trans('messages.report_abuse')]) !!}
                                    </div>

                                    @if($usersList->count() > 0)
                                        <div class="form-group">
                                            {!! Form::label('usersList',trans('general.users')) !!} :
                                            {!!
                                            Form::select('usersList',$usersList,null,['multiple'=>'multiple','name'=>'recipients[]','class'=>'form-control','id'=>'users'])
                                            !!}
                                        </div>
                                        @endif

                                                <!-- Submit Form Input -->
                                        <div class="form-group">
                                            {!! Form::submit(trans('general.submit'), ['class' => 'btn btn-primary form-control']) !!}
                                        </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>




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
                            <button type="button" type="submit" class="btn btn-success" href="">
                                {!! trans('general.send') !!}
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->