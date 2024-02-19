<!DOCTYPE html>
<html dir="rtl" class="no-js" lang="ar">
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

	<!-- Style--> 
        <!-- CSS
    ============================================ -->
    <link rel="stylesheet" href="{{asset('')}}student_assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('')}}student_assets/css/vendor/slick.css">
    <link rel="stylesheet" href="{{asset('')}}student_assets/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="{{asset('')}}student_assets/css/plugins/sal.css">
    <link rel="stylesheet" href="{{asset('')}}student_assets/css/plugins/feather.css">
    <link rel="stylesheet" href="{{asset('')}}student_assets/css/plugins/fontawesome.min.css">
    <link rel="stylesheet" href="{{asset('')}}student_assets/css/plugins/euclid-circulara.css">
    <link rel="stylesheet" href="{{asset('')}}student_assets/css/plugins/swiper.css">
    <link rel="stylesheet" href="{{asset('')}}student_assets/css/plugins/magnify.css">
    <link rel="stylesheet" href="{{asset('')}}student_assets/css/plugins/odometer.css">
    <link rel="stylesheet" href="{{asset('')}}student_assets/css/plugins/animation.css">
    <link rel="stylesheet" href="{{asset('')}}student_assets/css/plugins/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{asset('')}}student_assets/css/plugins/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('')}}student_assets/css/plugins/magnigy-popup.min.css">
    <link rel="stylesheet" href="{{asset('')}}student_assets/css/style.css">

	
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap" rel="stylesheet">
</head>
	
<body class="rbt-header-sticky">

    @include('student.layouts.inc.side_menu')
    @include('student.layouts.inc.mobile_menu')
    @include('student.layouts.inc.header')

    @yield('content')

    <!-- End Page Wrapper Area -->
    <div class="rbt-progress-parent">
        <svg class="rbt-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    @include('student.layouts.inc.footer')


        <!-- JS
    ============================================ -->
    <!-- Modernizer JS -->
    <script src="{{asset('')}}student_assets/js/vendor/modernizr.min.js"></script>
    <!-- jQuery JS -->
    <script src="{{asset('')}}student_assets/js/vendor/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('')}}student_assets/js/vendor/bootstrap.min.js"></script>
    <!-- Parallax JS -->
    <script src="{{asset('')}}student_assets/js/vendor/paralax.js"></script>
    <!-- sal.js -->
    <script src="{{asset('')}}student_assets/js/vendor/sal.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/swiper.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/magnify.min.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/jquery-appear.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/odometer.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/backtotop.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/isotop.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/imageloaded.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/countdown.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/wow.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/waypoint.min.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/easypie.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/text-type.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/jquery-one-page-nav.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/bootstrap-select.min.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/jquery-ui.js"></script>
    <script src="{{asset('')}}student_assets/js/vendor/magnify-popup.min.js"></script>
    <!-- Main JS -->
    <script src="{{asset('')}}student_assets/js/main.js"></script>
    <script src="{{asset('')}}student_assets/js/notify.js"></script>
        @if (session('success'))
            <script>
                $(document).ready(function(){ $.notify("{{ session('success') }}", {autoHideDelay: 5000, globalPosition: 'bottom left', className: 'success',clickToHide: true}); });
            </script>
        @endif
    
        @if (session('error'))
            <script>
                $(document).ready(function(){ $.notify("{{ session('error') }}", {autoHideDelay: 30000, globalPosition: 'bottom left', className: 'error',clickToHide: true}); });
            </script>
        @endif 

<script>
    $(document).ready(function() {
        // Attach click event handlers to your buttons to trigger the hidden file inputs
        $('.rbt-edit-photo').on('click', function() {
            // Trigger click on the hidden 'icon' input
            $('#icon').click();
        });

        $('.tutor-btn a').on('click', function(e) {
            e.preventDefault(); // Prevent default anchor action
            // Trigger click on the hidden 'cover' input
            $('#cover').click();
        });

        // Handle file selection for the icon
        $('#icon').on('change', function(e) {
            handleFileChange(e, 'icon');
        });

        // Handle file selection for the cover
        $('#cover').on('change', function(e) {
            handleFileChange(e, 'cover');
        });

        function handleFileChange(event, target) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                // Display the selected image
                if (target === 'icon') {
                    $('.rbt-avatars img').attr('src', e.target.result);
                } else if (target === 'cover') {
                    $('.tutor-bg-photo').css('background-image', 'url(' + e.target.result + ')');
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.payment-type').change(function() {
            // Get the selected payment type and lesson ID
            let paymentType = $(this).val();
            let lessonId = $(this).attr('name').split('-')[1];
            
            // Hide all payment type content divs
            $(`#balance-content-${lessonId}, #coupon-content-${lessonId}, #fawry-content-${lessonId}`).hide();
            
            // Show the selected payment type content div
            $(`#${paymentType}-content-${lessonId}`).show();
        });
    });
</script>
    @stack('scripts')
    
</body>
</html>
