<div class="navbar navbar-default navbar-material-blue-400" role="navigation">
    {{--navbar-fixed-top--}}
    <div class="navbar-header ">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand btn-material-yellow-A700 {{ Session::get('pullClass') }}"
           href="{{ URL::to('/') }}">
            <i class="fa  fa-home fa-xs"></i>
            {{ trans('general.ebook') }}</a>
        <a class="navbar-brand btn-material-default {{ Session::get('pullClass') }}"
           href="{{ URL::to('/backend') }}">
            <i class="fa  fa- fa-xs"></i>
            {{ trans('general.dashboard') }}</a>
    </div>

    <div class="navbar-collapse collapse navbar-responsive-collapse">

        <ul class="nav navbar-nav">

            <li><a href="/lang/en"><i
                            class="fa fa-xs fa-fw fa-language"></i> {{ trans('general.english') }}
                </a>
            </li>
            <li><a href="/lang/ar"><i
                            class="fa fa-xs fa-fw fa-language"></i> {{ trans('general.arabic') }}
                </a>
            </li>
            <li class="visible-xs well-material-red-A700">
                <a href="{{ URL::to('auth/logout') }}" class="">{{ trans('general.logout') }}</a>
            </li>

            {{----}}
            <li class="dropdown user user-menu hidden-xs">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <!-- The user image in the navbar-->
                    @if(count(Auth::user()->avatar) > 0)
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
                        @if(count(Auth::user()->avatar) > 0))
                            <img src="{{ asset('images/uploads/avatar/thumbnail/'.Auth::user()->avatar )}}"
                                 class="img-circle" alt="User Image">
                        @else
                            <img src="//www.gravatar.com/avatar/{!! md5(Auth::user()->email) !!}?s=64"
                                 alt="{!! Auth::user()->name !!}" class="user-image">
                        @endif

                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since {{  Auth::user()->created_at->format('d-M,Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Body -->
                    <li class="user-body">
                        <div class="col-xs-4 text-center">
                            <a href="{{ action('UserController@show',Auth::id()) }}">{{ trans('general.profile') }}</a>
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
        </ul>


        <ul class="nav navbar-nav nav-left {{ Session::get('pullClassReverse') }}">
            <li class="dropdown btn-material-pink">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="fa fa-fw fa-cogs"></i><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ action('Backend\UsersController@edit',Auth::id()) }}">{{ trans('general.edit_profile') }}</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="/lang/{{ (App::getLocale() == 'ar') ? 'en' : 'ar' }}">
                            {{ (App::getLocale() == 'ar') ? trans('general.english') : trans('general.arabic')  }}
                        </a></li>
                    <li class="divider"></li>
                    @if(Cache::get('Abilities.Admin.'.Auth::id()) | Cache::get('Abilities.Editor.'.Auth::id()))

                        <li><a href="/backend/translations">{{ trans('general.translations') }}</a></li>

                    @endif
                </ul>
            </li>
            @if(!Auth::user())
                <li class="btn-material-blue-A400"><a href="/auth/login"><i class="fa fa-fw fa-sign-in"></i>
                        {{ trans('general.login') }}</a></li>
            @endif
        </ul>


    </div>
</div>

