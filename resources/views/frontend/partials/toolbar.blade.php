<div class="navbar navbar-default navbar-material-blue-grey-800 navbar-fixed-top" role="navigation">
    <div class="navbar-header ">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="javascript:void(0)"><i
                    class="fa fa-fw fa-pencil fa-sm"></i>{{ trans('words.book') }}</a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="javascript:void(0)">Active</a></li>
            <li><a href="javascript:void(0)">Link</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b
                            class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="javascript:void(0)">الأكشن</a></li>
                    <li><a href="javascript:void(0)">Another action</a></li>
                    <li><a href="javascript:void(0)">Something else here</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Dropdown header</li>
                    <li><a href="javascript:void(0)">Separated link</a></li>
                    <li><a href="javascript:void(0)">One more separated link</a></li>
                </ul>
            </li>
        </ul>
        <form class="navbar-form {{ Session::get('pullClass') }}">
            <input type="text" class="form-control col-lg-8" placeholder="Search">
        </form>
        <ul class="nav navbar-nav nav-left {{ Session::get('pullClassReverse') }}" style="margin-right: 10px;">
            <li class="dropdown btn-material-pink">
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="fa fa-fw fa-cogs"></i><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="/backend">Control Panel</a></li>
                    <li><a href="/lang/{{ (App::getLocale() === 'ar') ? 'en' : 'ar' }}">
                            {{ (App::getLocale() === 'ar') ? trans('word.general.english') : trans('word.general.arabic')  }}
                        </a></li>
                    <li><a href="javascript:void(0)">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:void(0)">Separated link</a></li>
                </ul>
            </li>
            <li class="btn-material-blue"><a href="/auth/login"><i class="fa fa-fw fa-sign-in"></i> Login</a></li>
            <li class="btn-material-grey"><a href="javascript:void(0)"><i class="fa fa-fw fa-sign-out"></i> Sign Up</a>
            </li>

        </ul>

    </div>
</div>