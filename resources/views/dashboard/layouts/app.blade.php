<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: auto; min-height: 100%;">
<head>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="file-base-url" content="{{ getFileBaseURL() }}">

    <title>@yield('meta_title', get_setting('website_name').' | '.get_setting('site_motto'))</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description') )" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords') )">

    @yield('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('')}}images/favicon.ico">
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{asset('')}}css/vendors_css.css">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{asset('')}}css/style.css">
	<link rel="stylesheet" href="{{asset('')}}css/skin_color.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">
</head>
	
<body class="{{'hold-transition light-skin sidebar-mini theme-primary fixed rtl'}}" style="height: auto; min-height: 100%; font-family: 'Cairo', sans-serif;">

    <div class="wrapper">
        <div id="loader"></div>

        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
        @include('dashboard.layouts.inc.header')
        @include('dashboard.layouts.inc.aside')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-full">
                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
        </div>
        <!-- /.content-wrapper -->
        @include('dashboard.layouts.inc.footer')
        @include('dashboard.layouts.inc.controlle_sidebar')
    </div>
    <!-- ./wrapper -->


    <!-- Vendor JS -->
    <script src="{{asset('')}}js/vendors.min.js"></script>
    <script src="{{asset('')}}js/pages/chat-popup.js"></script>
    <script src="{{asset('')}}../assets/icons/feather-icons/feather.min.js"></script>

    <script src="{{asset('')}}../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
    <script src="{{asset('')}}../assets/vendor_components/moment/min/moment.min.js"></script>
    <script src="{{asset('')}}../assets/vendor_components/fullcalendar/fullcalendar.js"></script>
    
    <!-- EduAdmin App -->
    <script src="{{asset('')}}js/template.js"></script>
    <script src="{{asset('')}}js/pages/dashboard.js"></script>
    <script src="{{asset('')}}js/pages/calendar.js"></script>

    <script src="{{asset('')}}js/pages/toastr.js"></script>
    <script src="{{asset('')}}js/pages/notification.js"></script>
    
	<script src="{{asset('')}}assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js"></script>
    <script src="{{asset('')}}js/pages/advanced-form-element.js"></script>

    <script src="{{asset('')}}../assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
	<script src="{{asset('')}}../assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
	<script src="{{asset('')}}../assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
	<script src="{{asset('')}}../assets/vendor_components/select2/dist/js/select2.full.js"></script>
	<script src="{{asset('')}}../assets/vendor_plugins/input-mask/jquery.inputmask.js"></script>
	<script src="{{asset('')}}../assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="{{asset('')}}../assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<script src="{{asset('')}}../assets/vendor_components/moment/min/moment.min.js"></script>
	<script src="{{asset('')}}../assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="{{asset('')}}../assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<script src="{{asset('')}}../assets/vendor_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="{{asset('')}}../assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<script src="{{asset('')}}../assets/vendor_plugins/iCheck/icheck.min.js"></script>
    
    <script>
        $(document).ready(function() {
            @if(session('success'))
                $.toast({
                    heading: 'Success',
                    text: '{{ session('success') }}',
                    showHideTransition: 'slide',
                    icon: 'success',
                    position: 'top-right'
                });
            @endif

            @if(session('error'))
                $.toast({
                    heading: 'Error',
                    text: '{{ session('error') }}',
                    showHideTransition: 'slide',
                    icon: 'error',
                    position: 'top-right'
                });
            @endif
        });
    </script>
    @stack('scripts')
    
</body>
</html>
