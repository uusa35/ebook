    <div class="col-xs-12 col-lg-12">

                <!-- START CONTENT ITEM -->

                {!! Form::open(['action'=>'HomeController@sendContactUs','method'=>'post'],['class'=>'form-horizontal']) !!}
                    <fieldset>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 control-label" for="field_01">{{ ucfirst(trans('general.name')) }}</label>
                            <div class="col-xs-12 col-sm-8">
                                <input type="text" class="form-control" name="name" id="field_01">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 control-label" for="field_02">{{ ucfirst(trans('general.mobile')) }}</label>
                            <div class="col-xs-12 col-sm-8">
                                <input type="text" class="form-control" name="mobile" id="field_02">
                                <p class="help-block">{{ ucfirst(trans('messages.please_use')) }}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 control-label" for="field_03">{{ ucfirst(trans('general.email')) }}</label>
                            <div class="col-xs-12 col-sm-8">
                                <input type="text" class="form-control" name="email" id="field_03">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 control-label" for="field_04">{{ ucfirst(trans('general.subject')) }}</label>
                            <div class="col-xs-12 col-sm-8">
                                <input type="text" class="form-control" name="subject" id="field_04">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 control-label" for="field_05">{{ ucfirst(trans('general.content')) }}</label>
                            <div class="col-xs-12 col-sm-8">
                                <textarea class="form-control" rows="5" name="content" id="field_05"></textarea>
                                <p class="help-block">Max. 250 characters</p>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-material-deep-purple-A400 {!! Session::get('pullClassReverse') !!}">{{ ucfirst(trans('general.send')) }} <i class="icon-chevron-right icon-white"></i> </button>
                        </div>
                    </fieldset>
                {!! Form::close() !!}
                <!-- END CONTENT ITEM -->

            </div>


