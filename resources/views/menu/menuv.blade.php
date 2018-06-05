<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('/') }}" class="site_title">  <img src="{{asset('img/logo.png')}}"> <span>{{ config('app.name', 'Laravel') }}</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        @guest
        @else
            <div class="profile clearfix">
                <div class="profile_pic">
                    <img src="{{ asset(Auth::user()->profilepicture_filename) }}" alt="..." class="img-circle profile_img">
                </div>
                <div class="profile_info">
                    <span>Bienvenido,</span>
                    <h2>{{ Auth::user()->name }}</h2>
                </div>
            </div>
    @endguest
    <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->

        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">

                    <li class="{{ active(url('/home'))? 'current-page' : '' }}"><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Dashboard </a>

                    </li>
                    @guest
                    @else
                        <li class="{{ active(url('/clients'))? 'current-page' : '' }}"><a href="{{ url('/clients') }}"><i class="fa fa-users"></i> Clientes </a></li>
                        <li class="{{ active(url('/products'))? 'current-page' : '' }}"><a href="{{ url('/products') }}"><i class="fa fa-briefcase"></i> Productos </a></li>
                        @if(Auth::user()->admin)
                            <li><a><i class="fa fa-calculator"></i> Administración <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    <li><a href="{{ url('/comunicados/create') }}">Nuevo comunicado</a></li>
                                </ul>
                            </li>
                        @endif
                    @endguest


                </ul>
            </div>


        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings" href="{{ route('editUserweb') }}">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            @guest
            @else
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
            @endguest
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>