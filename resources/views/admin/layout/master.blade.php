<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Atoshin</title>
    <link rel="icon" type="image/png" href="{{asset('admin/dist/img/Atoshin-hexagon.png')}}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('admin/js/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('admin/js/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/leaflet/leaflet.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @yield('styles')

    <style>


        ::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }
    </style>



    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

@include('admin.layout.header')
@include('admin.layout.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    @include('admin.layout.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('admin/js/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('admin/js/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('admin/js/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('admin/js/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('admin/js/raphael/raphael.min.js')}}"></script>
<script src="{{asset('admin/js/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('admin/js/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('admin/js/chart.js/Chart.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- AdminLTE for demo purposes -->
{{--<script src="dist/js/demo.js"></script>--}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard2.js')}}"></script>
<script src="{{asset('admin/leaflet/leaflet.js')}}"></script>

@if(\Illuminate\Support\Facades\Session::has('message'))
    <script type="text/javascript">
        Swal.fire({
            target: 'body',
            icon: '{{\Illuminate\Support\Facades\Session::has('icon') ? \Illuminate\Support\Facades\Session::get('icon') : 'warning'}}',
            title: '{{\Illuminate\Support\Facades\Session::get('message')}}',
            showCancelButton: false,
            showConfirmButton: true,
            timer: 100000,

        })
    </script>

@endif

@yield('scripts')

</body>
</html>
