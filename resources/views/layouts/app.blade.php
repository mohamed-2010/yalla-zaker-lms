<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">

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
    @yield('styles')

</head>
	
<body class="hold-transition theme-primary bg-img" style="background-image: url({{asset('')}}images/auth-bg/bg-1.jpg); font-family: 'Cairo', sans-serif;">

    @yield('content')


	<!-- Vendor JS -->
	<script src="{{asset('')}}js/vendors.min.js"></script>
	<script src="{{asset('')}}js/pages/chat-popup.js"></script>
    <script src="{{asset('')}}assets/icons/feather-icons/feather.min.js"></script>	

    @yield('script')
    
</body>
</html>
