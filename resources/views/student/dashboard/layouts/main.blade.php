@extends('student.layouts.app')

@section('meta_title')
    
@endsection

@section('content')
<div class="rbt-page-banner-wrapper">
    <!-- Start Banner BG Image  -->
    <div class="rbt-banner-image"></div>
    <!-- End Banner BG Image  -->
</div>
<!-- Start Card Style -->
<div class="rbt-dashboard-area rbt-section-overlayping-top rbt-section-gapBottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Start Dashboard Top  -->
                <div class="rbt-dashboard-content-wrapper">
                    <div class="tutor-bg-photo bg_image bg_image--23 height-350" style="background-image: url({{ auth()->user()->getFirstMedia('students_cover') != null ? auth()->user()->getFirstMedia('students_cover')->getUrl() : ""}})"></div>
                    <!-- Start Tutor Information  -->
                    <div class="rbt-tutor-information">
                        <div class="rbt-tutor-information-left">
                            <div class="thumbnail rbt-avatars size-lg">
                                <img src="{{ auth()->user()->getFirstMedia('students') != null ? auth()->user()->getFirstMedia('students')->getUrl() : 'assets/images/team/avatar-2.jpg' }}" alt="Instructor">
                            </div>
                            <div class="tutor-content">
                                <h5 class="title">{{ auth()->user()->name }}</h5>
                            </div>
                        </div>
                    </div>
                    <!-- End Tutor Information  -->
                </div>
                <!-- End Dashboard Top  -->

                <div class="row g-5">
                    <div class="col-lg-3">
                        @include('student.dashboard.layouts.sidebar')
                    </div>

                    @yield('body')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Card Style -->
@stack('scripts')
@endsection