<!-- Logo -->
{{--<a href="{{ URL::to('/backend') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>LT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Admin</b>LTE</span>
</a>--}}

<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation" style="padding-left: 100px; padding-right:100px;">

    <!-- Navbar Right Menu -->

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <a class="navbar-brand btn-material-yellow-A700 {{ Session::get('pullClass') }}" href="{{ URL::to('/') }}">
                <i class="fa  fa-home fa-xs"></i>
                {{ trans('general.ebook') }}</a>
            <!-- Messages: style can be found in dropdown.less-->
            {{--<li class="dropdown messages-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-o"></i>
                    <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">You have 4 messages</li>
                    <li>
                        <!-- inner menu: contains the messages -->
                        <ul class="menu">
                            <li><!-- start message -->
                                <a href="#">
                                    <div class="pull-left">
                                        <!-- User Image -->
                                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                    </div>
                                    <!-- Message title and timestamp -->
                                    <h4>
                                        Support Team
                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                    </h4>
                                    <!-- The message -->
                                    <p>Why not buy a new awesome theme?</p>
                                </a>
                            </li>
                            <!-- end message -->
                        </ul>
                        <!-- /.menu -->
                    </li>
                    <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
            </li>--}}
            <!-- /.messages-menu -->

            <!-- Notifications Menu -->
            {{--<li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">You have 10 notifications</li>
                    <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                            <li><!-- start notification -->
                                <a href="#">
                                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                </a>
                            </li>
                            <!-- end notification -->
                        </ul>
                    </li>
                    <li class="footer"><a href="#">View all</a></li>
                </ul>
            </li>--}}
            <!-- Tasks Menu -->
            {{--<li class="dropdown tasks-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-flag-o"></i>
                    <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">You have 9 tasks</li>
                    <li>
                        <!-- Inner menu: contains the tasks -->
                        <ul class="menu">
                            <li><!-- Task item -->
                                <a href="#">
                                    <!-- Task title and progress text -->
                                    <h3>
                                        Design some buttons
                                        <small class="pull-right">20%</small>
                                    </h3>
                                    <!-- The progress bar -->
                                    <div class="progress xs">
                                        <!-- Change the css width attribute to simulate progress -->
                                        <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                             role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                             aria-valuemax="100">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- end task item -->
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="#">View all tasks</a>
                    </li>
                </ul>
            </li>--}}
            <!-- User Account Menu -->
            <li class="dropdown user user-menu ">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    @if(count(Auth::user()->avatar) > 1)
                        <img src="{{ asset('images/uploads/avatar/thumbnail/'.Auth::user()->avatar )}}"
                             class="user-image" alt="User Image">
                    @else
                        <img src="//www.gravatar.com/avatar/{!! md5(Auth::user()->email) !!}?s=64"
                             alt="{!! Auth::user()->name !!}" class="user-image">
                        @endif
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- The user image in the menu -->
                    <li class="user-header">
                        @if(count(Auth::user()->avatar) > 1)
                            <img src="{{ asset('images/uploads/avatar/thumbnail/'.Auth::user()->avatar )}}"
                                 class="img-circle" alt="User Image">
                        @else
                            <img src="//www.gravatar.com/avatar/{!! md5(Auth::user()->email) !!}?s=64"
                                 alt="{!! Auth::user()->name !!}" class="user-image">
                        @endif

                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since {{ Auth::user()->created_at->format('d-M,Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Body -->
                    <li class="user-body">
                        <div class="col-xs-4 text-center">
                            <a href="{{ action('UserController@show',Auth::id()) }}" >{{ trans('general.profile') }}</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="{{ action('Backend\MessagesController@index') }}">{{ trans('general.inbox') }}</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="{{ URL::to('auth/logout') }}" class="">{{ trans('general.logout') }}</a>
                        </div>
                    </li>
                    {{--<!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="{{ action('UserController@show',Auth::id()) }}" class="btn btn-default btn-flat">{{ trans('general.profile') }}</a>
                        </div>
                        <div class="pull-right">
                            <a href="{{ URL::to('auth/logout') }}" class="btn btn-default btn-flat">{{ trans('general.logout') }}</a>
                        </div>
                    </li>--}}
                </ul>
            </li>

            <li><a href="/lang/en"><i
                            class="fa fa-xs fa-fw fa-language"></i> {{ trans('general.english') }}
                </a>
            </li>
            <li><a href="/lang/ar"><i
                            class="fa fa-xs fa-fw fa-language"></i> {{ trans('general.arabic') }}
                </a>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li class="dropdown btn-material-pink">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="fa fa-fw fa-cogs"></i><b class="caret"></b></a>

                <ul class="dropdown-menu">
                    <li><a href="{{ action('Backend\UsersController@edit',Auth::id()) }}">{{ trans('general.edit_profile') }}</a></li>
                    <li class="divider"></li>
                    <li><a href="/lang/{{ (App::getLocale() == 'ar') ? 'en' : 'ar' }}">
                            {{ (App::getLocale() == 'ar') ? trans('general.english') : trans('general.arabic')  }}
                        </a></li>
                </ul>
            </li>
            <li class="well-material-red-A700"><a href="/auth/logout"><i
                            class="fa fa-xs fa-fw fa-sign-out"></i> {{ trans('general.logout') }}
                </a>
            </li>
        </ul>
    </div>
</nav>