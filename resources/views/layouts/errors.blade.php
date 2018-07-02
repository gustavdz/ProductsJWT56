<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('img/favicon.png')}}" type="image/ico" />
    <title>{{ config('app.name', 'EcuaBill') }} | @yield('topnavbar')</title>
    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
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
    <!-- PNotify -->
    <link href="{{asset('js/pnotify/dist/pnotify.css')}}" rel="stylesheet">
    <link href="{{asset('js/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="{{asset('js/google-code-prettify/bin/prettify.min.css')}}" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('style')
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        @yield('content')
    </div>
</div>

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
<!-- pnotify -->
<script src="{{asset('js/pnotify/dist/pnotify.js')}}"></script>
<script src="{{asset('js/pnotify/dist/pnotify.buttons.js')}}"></script>
<!-- bootstrap-wysiwyg -->
<script src="{{asset('js/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')}}"></script>
<script src="{{asset('js/jquery.hotkeys/jquery.hotkeys.js')}}"></script>
<script src="{{asset('js/google-code-prettify/src/prettify.js')}}"></script>

<!--  Google Maps Plugin
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

-->

</body>
</html>
