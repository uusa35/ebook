<div class="row">
    <div class="col-lg-12">
        <div class="navbar navbar-default navbar-material-blue-400" role="navigation">
            {{--navbar-fixed-top--}}
            <div class="navbar-header ">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ URL::to('/') }}">
                    <i class="fa  fa-home fa-xs"></i>
                    {{ trans('general.main') }}</a>
            </div>
            <div class="navbar-collapse collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle"
                           data-toggle="dropdown">{{ trans('general.categories') }} <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @foreach($fieldsCategories as $category)
                                <li><a href="javascript:void(0)"> {{ $category->name }}</a></li>
                                <li class="divider"></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="/frontend/books"><i class="fa fa-xs fa-fw fa-book"></i> {{ trans('general.book') }}</a>
                    </li>
                    <li><a href="{{ action('HomeController@getContactus') }}"><i
                                    class="fa fa-xs fa-fw fa-info"></i> {{ trans('general.contactus') }}
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav nav-left {{ Session::get('pullClassReverse') }}">
                    <li class="dropdown btn-material-pink">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i
                                    class="fa fa-fw fa-cogs"></i><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @if(Auth::user())
                                <li><a href="/backend">{{ trans('general.control_panel') }}</a></li>
                                <li><a href="/backend/profile">{{ trans('general.profile') }}</a></li>
                            @endif
                            <li><a href="/lang/{{ (App::getLocale() === 'ar') ? 'en' : 'ar' }}">
                                    {{ (App::getLocale() === 'ar') ? trans('general.english') : trans('general.arabic')  }}
                                </a></li>
                            @if(!Auth::user())
                                <li><a href="javascript:void(0)">{{ trans('general.sign_up') }}</a></li>
                            @endif
                            @if(Auth::user())
                                <li class="divider"></li>
                                <li><a href="/auth/logout">{{ trans('general.logout') }}</a></li>
                            @endif
                        </ul>
                    </li>
                    @if(!Auth::user())
                        <li class="btn-material-blue-A400"><a href="/auth/login"><i class="fa fa-fw fa-sign-in"></i>
                                Login</a></li>
                    @endif
                    {{--<li class="btn-material-grey"><a href="javascript:void(0)"><i class="fa fa-fw fa-sign-out"></i> Sign Up</a>--}}
                    </li>

                </ul>
                <form class="navbar-form {{ Session::get('pullClassReverse') }}" style="margin-top: 12px;" method="post" action="{{ action('BookController@getShowSearchResults') }}">
                    {!! Form::token() !!}
                    <input type="text" name="search" class="col-lg-5 form-control " placeholder="{{ trans('general.search') }}" style="float: {{ (App::getLocale() === 'en') ? 'left' : 'right' }}; width: 80%; padding: 0px; margin: 0px;">
                    <button type="submit" class="{{ Config::get('button.btn-search') }} {{ Session::get('pullClassReverse') }}"></button>
                {!! Form::close() !!}


            </div>
        </div>
    </div>
</div>
