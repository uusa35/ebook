<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar hidden-xs hidden-sm hidden-md">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">


        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <a class="" href="{{ action('Backend\DashboardController@index') }}"><img
                            class="center-block img-responsive img-circle" src="{{ asset('images/logo.png') }}" alt=""/></a>
            </div>

        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu {{ session('pullClass') }}">

            @if(Session::has('roles'))
                @if(Cache::has('Abilities.Admin.'.Auth::id()))
                    @foreach(Cache::get('Modules.Admin.'.Auth::id()) as $module)
                        <li><a href="{{ URL::to('backend/'.strtolower($module)) }}"><i class="fa fa-folder"></i>
                                <span>{{ (trans('general.'.strtolower($module))) }}</span></a></li>
                    @endforeach
                @elseif(Cache::has('Abilities.Editor.'.Auth::id()))
                    @foreach(Cache::get('Modules.Editor.'.Auth::id()) as $module)
                        <li><a href="{{ URL::to('backend/'.strtolower($module)) }}"><i class="fa fa-folder"></i>
                                <span>{{ (trans('general.'.strtolower($module))) }}</span></a></li>
                    @endforeach
                @elseif(Cache::has('Abilities.Author.'.Auth::id()))
                    @foreach(Cache::get('Modules.Author.'.Auth::id()) as $module)
                        <li><a href="{{ URL::to('backend/'.strtolower($module)) }}"><i class="fa fa-folder"></i>
                                <span>{{ (trans('general.'.strtolower($module))) }}</span></a></li>
                    @endforeach
                @endif
            @endif


        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>