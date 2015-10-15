    <div class="col-xs-12 col-lg-12">

                <!-- START CONTENT ITEM -->

                {!! Form::open(['action'=>'HomeController@sendContactUs','method'=>'post'],['class'=>'form-horizontal']) !!}
                    <fieldset>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 control-label" for="field_01">{{ trans('word.name') }}</label>
                            <div class="col-xs-12 col-sm-8">
                                <input type="text" class="form-control" name="name" id="field_01">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 control-label" for="field_02">{{ trans('word.mobile') }}</label>
                            <div class="col-xs-12 col-sm-8">
                                <input type="text" class="form-control" name="mobile" id="field_02">
                                <p class="help-block">Please use ##-###-###-##</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 control-label" for="field_03">{{ trans('word.email') }}</label>
                            <div class="col-xs-12 col-sm-8">
                                <input type="text" class="form-control" name="email" id="field_03">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 control-label" for="field_04">{{ trans('word.subject') }}</label>
                            <div class="col-xs-12 col-sm-8">
                                <input type="text" class="form-control" name="subject" id="field_04">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12 col-sm-4 control-label" for="field_05">{{ trans('word.content') }}</label>
                            <div class="col-xs-12 col-sm-8">
                                <textarea class="form-control" rows="5" name="content" id="field_05"></textarea>
                                <p class="help-block">Max. 250 characters</p>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary {!! Session::get('pullClassReverse') !!}">{{ trans('word.send') }} <i class="icon-chevron-right icon-white"></i> </button>
                        </div>
                    </fieldset>
                {!! Form::close() !!}
                <!-- END CONTENT ITEM -->

            </div>


