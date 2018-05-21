<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('img/favicon.png')}}" type="image/ico" />

    <title>{{ config('app.name', 'EcuaBill') }}</title>

    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('css/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('css/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="{{asset('css/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('css/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('css/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('css/custom.min.css')}}" rel="stylesheet">

    <!-- Datatables -->
    <link href="{{asset('css/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('style')
</head>
<body class="@yield('body-class')">
<div class="container body">
    <div class="main_container">
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
                                        <li class="{{ active(url('/cliente'))? 'current-page' : '' }}"><a href="{{ url('/cliente') }}">Clientes</a></li>
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

        <!-- top navigation -->
        <div class="top_nav hidden-print">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">

                        @guest
                        <li><a href="{{ route('login') }}">Login</a></li>

                        @else
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset(Auth::user()->profilepicture_filename) }}" alt="">
                                      {{ Auth::user()->name }}
                                    <span class=" fa fa-angle-down"></span>

                                </a>

                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a href="javascript:;"> Profile</a></li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li><a href="javascript:;">Help</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out pull-right"></i>  Log Out
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ url('/') }} </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest


                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <li>
                                    <a>
                                        <span class="image"><img src="{{asset('img/img.jpg')}}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="{{asset('img/img.jpg')}}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="{{asset('img/img.jpg')}}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <span class="image"><img src="{{asset('img/img.jpg')}}" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->
        <div class="right_col" role="main">
             @yield('content')
        </div>


        @include('includes.footer')
    </div>
</div>







<script>
  /*  $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        // other options
        onConfirm: function() {
            removerow()
        },
        onCancel: function() {
            alert('You didn\'t choose');
        },
    });*/

</script>

@include('includes.modal')


<!-- jQuery -->
<script src="{{asset('js/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('js/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('js/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('js/nprogress/nprogress.js')}}"></script>
<!-- Chart.js -->
<script src="{{asset('js/Chart.js/dist/Chart.min.js')}}"></script>
<!-- gauge.js -->
<script src="{{asset('js/gauge.js/dist/gauge.min.js')}}"></script>
<!-- bootstrap-progressbar -->
<script src="{{asset('js/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('js/iCheck/icheck.min.js')}}"></script>
<!-- Skycons -->
<script src="{{asset('js/skycons/skycons.js')}}"></script>
<!-- Flot -->
<script src="{{asset('js/Flot/jquery.flot.js')}}"></script>
<script src="{{asset('js/Flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('js/Flot/jquery.flot.time.js')}}"></script>
<script src="{{asset('js/Flot/jquery.flot.stack.js')}}"></script>
<script src="{{asset('js/Flot/jquery.flot.resize.js')}}"></script>
<!-- Flot plugins -->
<script src="{{asset('js/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
<script src="{{asset('js/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
<script src="{{asset('js/flot.curvedlines/curvedLines.js')}}"></script>
<!-- DateJS -->
<script src="{{asset('js/DateJS/build/date.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('js/jqvmap/dist/jquery.vmap.js')}}"></script>
<script src="{{asset('js/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
<script src="{{asset('js/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{asset('js/moment/min/moment.min.js')}}"></script>
<script src="{{asset('js/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

<!-- Custom Theme Scripts -->
<script src="{{asset('js/custom.min.js')}}"></script>
<!-- Datatables -->
<script src="{{asset('js/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('js/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('js/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('js/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('js/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('js/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('js/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('js/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('js/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('js/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
<script src="{{asset('js/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
<script src="{{asset('js/jszip/dist/jszip.min.js')}}"></script>
<script src="{{asset('js/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('js/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{asset('js/Select/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('js/RowReorder/js/dataTables.rowReorder.js')}}"></script>
<script src="{{asset('js/RowGroup/js/dataTables.rowGroup.min.js')}}"></script>
<script src="{{asset('js/ColReorder/js/dataTables.colReorder.min.js')}}"></script>
<script src="{{asset('js/AutoFill/js/dataTables.autoFill.min.js')}}"></script>
<!-- ECharts -->
<script src="{{asset('js/echarts/dist/echarts.min.js')}}"></script>
<!-- validator -->
<script src="{{asset('js/validator/validator.js')}}"></script>

@yield('scripts')

<!--  Google Maps Plugin
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

-->

</body>
</html>
