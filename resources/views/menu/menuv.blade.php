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
                    <span>Welcome,</span>
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

                    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Home </a>

                    </li>
                    @guest
                    @else
                        <li><a><i class="fa fa-calculator"></i> Administracion <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li >
                                    <a>
                                        Proyectos
                                        <span class="fa fa-chevron-down"></span>
                                    </a>
                                    <ul class="nav child_menu">
                                        <li  class="sub_menu {{ active(url('/proyectos'))? 'current-page' : '' }}"><a href="{{ url('/proyectos') }}">Listado de Proyectos</a>
                                        </li>
                                        <li class="sub_menu {{ active(url('/proyectos/create'))? 'current-page' : '' }}"><a href="{{ url('/proyectos/create') }}">Proyecto Nuevo</a>
                                        </li>

                                    </ul>
                                </li>



                            </ul>
                        </li>
                        <li><a><i class="fa fa-gear"></i> Configuracion <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li class="{{ active(url('/clients'))? 'current-page' : '' }}"><a href="{{ url('/clients') }}">Clientes</a></li>
                                <li class="{{ active(url('/departamentos'))? 'current-page' : '' }}"><a href="{{ url('/departamentos') }}">Departamentos</a></li>
                                <li class="{{ active(url('/rubros'))? 'current-page' : '' }}"><a href="{{ url('/rubros') }}">Rubros</a></li>
                                <li class="{{ active(url('/usuarios'))? 'current-page' : '' }}"><a href="{{ url('/usuarios') }}">Usuarios</a></li>
                                <li class="{{ active(url('/contactos'))? 'current-page' : '' }}"><a href="{{ url('/contactos') }}">Contactos</a></li>
                            </ul>
                        </li>
                    @endguest


                </ul>
            </div>


        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>