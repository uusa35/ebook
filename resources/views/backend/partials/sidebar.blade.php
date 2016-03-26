<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar hidden-xs hidden-sm hidden-md">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">


        <div class="row">
            <div class="col-lg-6 col-lg-offset-3" style="margin-bottom: 6px;">
                <a class="" href="{{ action('Backend\DashboardController@index') }}"><img
                            class="center-block img-responsive img-thumbnail" src="{{ asset('images/logo-main.png') }}"
                            alt=""/></a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu {{ session('pullClass') }}">


            @if(Cache::has('ROLE.'.Auth::id()))
                @foreach(Cache::get('MODULES.'.Auth::id()) as $module)
                    <li><a href="{{ URL::to('backend/'.strtolower($module)) }}"><i class="fa fa-folder"></i>
                            <span>{{ (ucfirst(trans('general.'.strtolower($module)))) }}</span></a></li>
                @endforeach
            @endif

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>