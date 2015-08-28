<html>

<head>


</head>

<body>

    <!-- Your site -->
<div class="container">
    {{--menu --}}


    <div class="row pull-right">
        <a class="btn btn-material-pink btn-social-icon btn-twitter">
            <i class="fa fa-twitter"></i>
        </a>
        <a class="btn btn-material-blue-800 btn-social-icon btn-facebook">
            <i class="fa fa-facebook"></i>
        </a>
        <a class="btn btn-material-green btn-social-icon btn-github">
            <i class="fa fa-github"></i>
        </a>

    </div>


    <div class="row">

        <div class="col-lg-3 pull-left">
            <a class="btn btn-social btn-block btn-microsoft btn-material-light-blue-500">
                <i class="fa fa-twitter"></i> Sign in with Twitter
            </a>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-5">
            <ul class="nav nav-tabs btn-material-pink" style="margin-bottom: 15px;">
                <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                <li><a href="#profile" data-toggle="tab">Profile</a></li>
                <li class="disabled"><a>Disabled</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                        Dropdown <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#dropdown1" data-toggle="tab">Action</a></li>
                        <li class="divider"></li>
                        <li><a href="#dropdown2" data-toggle="tab">Another action</a></li>
                    </ul>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in " id="home">
                    <p>بسم الله الرحمن الرحيم والصلاه والسلام على اشرف المرسلين</p>
                </div>
                <div class="tab-pane fade" id="profile">
                    <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.</p>
                </div>
                <div class="tab-pane fade" id="dropdown1">
                    <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</p>
                </div>
                <div class="tab-pane fade" id="dropdown2">
                    <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-lg-5">
            <form class="form-horizontal">
                <fieldset>
                    <legend>Legend</legend>
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Checkbox
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputFile" class="col-lg-2 control-label">File</label>
                        <div class="col-lg-10">
                            <input type="text" readonly="" class="form-control floating-label" placeholder="Browse...">
                            <input type="file" id="inputFile" multiple="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textArea" class="col-lg-2 control-label">Textarea</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="textArea"></textarea>
                            <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Radios</label>
                        <div class="col-lg-10">
                            <div class="radio radio-primary">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                                    Option one is this
                                </label>
                            </div>
                            <div class="radio radio-primary">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                    Option two can be something else
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Selects</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="select">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            <br>
                            <select multiple="" class="form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-4 well">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-4 pull-left">
                        <i class="fa fa-fw fa-users"></i> | <i class="fa fa-fw fa-users"></i> | <i class="fa fa-fw fa-users"></i>
                    </div>
                    <div class="col-lg-4 pull-right">
                        <i class="fa fa-fw fa-users"></i> | <i class="fa fa-fw fa-users"></i> | <i class="fa fa-fw fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <img class="img-responsive" src="http://placehold.it/350x400" alt=""/>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-4 pull-left">
                            <i class="fa fa-fw fa-users"></i> | <i class="fa fa-fw fa-users"></i> | <i class="fa fa-fw fa-users"></i>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <i class="fa fa-fw fa-users"></i> | <i class="fa fa-fw fa-users"></i> | <i class="fa fa-fw fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="thumb-pad">

                            <img src="http://placehold.it/300x400" alt="">
                            <div class="caption">
                                <h5>Thumbnail label</h5>
                                <p>Text.</p>
                                <a href="#" class="btn">Read More</a>
                            </div>

                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <i class="fa fa-fw fa-users"></i> | <i class="fa fa-fw fa-users"></i> | <i class="fa fa-fw fa-users"></i>
                        </div>
                        <div class="col-lg-6">
                            <i class="fa fa-fw fa-users"></i> | <i class="fa fa-fw fa-users"></i> | <i class="fa fa-fw fa-users"></i>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-lg-3">

    </div>





</div>
    <!-- Your site ends -->

    {{--<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script src="material/scripts/ripples.js"></script>
    <script src="material/scripts/material.js"></script>--}}



</body>

</html>
