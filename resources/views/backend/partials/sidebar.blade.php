<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- search form (Optional) -->
        {{--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>--}}
        <!-- /.search form -->

        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <a class="" href="{{ action('Backend\DashboardController@index') }}"><img
                            class="center-block img-responsive img-circle" src="{{ asset('images/logo.png') }}" alt=""/></a>
            </div>

        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

            @if(Session::has('roles'))
                @if(Cache::has('Abilities.Admin.'.Auth::id()))
                    @foreach(Cache::get('Modules.Admin.'.Auth::id()) as $module)
                        <li><a href="{{ URL::to('backend/'.strtolower($module)) }}"><i class="fa fa-folder"></i>
                                <span>{{ trans('general.'.$module) }}</span></a></li>
                    @endforeach
                @elseif(Cache::has('Abilities.Editor.'.Auth::id()))
                    @foreach(Cache::get('Modules.Editor.'.Auth::id()) as $module)
                        <li><a href="{{ URL::to('backend/'.strtolower($module)) }}"><i class="fa fa-folder"></i>
                                <span>{{ trans('general.'.$module) }}</span></a></li>
                    @endforeach
                @elseif(Cache::has('Abilities.Author.'.Auth::id()))
                    @foreach(Cache::get('Modules.Author.'.Auth::id()) as $module)
                        <li><a href="{{ URL::to('backend/'.strtolower($module)) }}"><i class="fa fa-folder"></i>
                                <span>{{ trans('general.'.$module) }}</span></a></li>
                    @endforeach
                @endif
            @endif


            {{--<!-- Optionally, you can add icons to the links -->
            <li><a href="{{ action('Backend\UsersController@index') }}"><i class="fa fa-users"></i>
                    <span>Users</span></a></li>
            <li><a href="{{ action('Backend\moduleissionsController@index') }}"><i class="fa fa-pencil"></i> <span>moduleissions</span></a>
            </li>
            <li><a href="{{ action('Backend\RolesController@index') }}"><i class="fa fa-table"></i>
                    <span>Roles</span></a></li>
            <li><a href="{{ action('Backend\RolesController@index') }}"><i class="fa fa-book"></i>
                    <span>Books</span></a></li>
            <li><a href="{{ action('Backend\RolesController@index') }}"><i class="fa fa-files-o"></i>
                    <span>Categories</span></a></li>
            <li><a href="{{ action('Backend\RolesController@index') }}"><i class="fa fa-inbox"></i>
                    <span>Inbox</span></a></li>
            <li><a href="{{ action('Backend\RolesController@index') }}"><i class="fa fa-comments"></i>
                    <span>Comments</span></a></li>
            <li><a href="{{ action('Backend\RolesController@index') }}"><i class="fa fa-map-signs"></i> <span>Ads</span></a>
            </li>
            <li><a href="{{ action('Backend\RolesController@index') }}"><i class="fa fa-graduation-cap"></i> <span>Conditions</span></a>
            </li>--}}

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>