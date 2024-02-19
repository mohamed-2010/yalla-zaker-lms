@extends('student.layouts.app')

@section('meta_title')
    
@endsection

@section('content')

<div class="rbt-page-banner-wrapper">
    <!-- Start Banner BG Image  -->
    <div class="rbt-banner-image"></div>
    <!-- End Banner BG Image  -->
    <div class="rbt-banner-content">
        <!-- Start Banner Content Top  -->
        <div class="rbt-banner-content-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Start Breadcrumb Area  -->
                        <ul class="page-list">
                            <li class="rbt-breadcrumb-item"><a href="index.html">الرئيسيه</a></li>
                            <li>
                                <div class="icon-right"><i class="feather-chevron-right"></i></div>
                            </li>
                            <li class="rbt-breadcrumb-item active">المدرسين</li>
                        </ul>
                        <!-- End Breadcrumb Area  -->

                        <div class=" title-wrapper">
                            <h1 class="title mb--0">{{ $subject->name }}</h1>
                            <a href="#" class="rbt-badge-2">
                                <div class="image">🎉</div> {{ $teachers->count() }} مدرسين 
                            </a>
                        </div>

                        <p class="description"> </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner Content Top  -->
        <!-- Start Course Top  -->
        <div class="rbt-course-top-wrapper mt--40">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5 col-md-12">
                        <div class="rbt-sorting-list d-flex flex-wrap align-items-center">
                            <div class="rbt-short-item">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Course Top  -->
    </div>
</div>

<div class="rbt-section-overlayping-top rbt-section-gapBottom masonary-wrapper-activation">
    <div class="container">
        <!-- Start Card Area -->
        <div class="row row--15">
            <div class="col-lg-12">
                <div class="mesonry-list grid-metro2">
                    <div class="resizer"></div>
                    @foreach($teachers as $teacher)
                        <!-- Start Single Card  -->
                        <div class="maso-item">
                            <div class="rbt-card variation-01 rbt-hover card-list-2">
                                <div class="rbt-card-img">
                                    <a href="{{ route('subject.details', ['subject_id' =>  encrypt($subject->id), 'teacher_id' =>  encrypt($teacher->id)]) }}">
                                        <img src="{{ $teacher->getFirstMedia('teachers') != null ? $teacher->getFirstMedia('teachers')->getUrl() : "" }}" alt="Card image">
                                    </a>
                                </div>
                                <div class="rbt-card-body">

                                    <h4 class="rbt-card-title"><a href="{{ route('subject.details', ['subject_id' =>  encrypt($subject->id), 'teacher_id' =>  encrypt($teacher->id)]) }}">{{ $teacher->name }}</a>
                                    </h4>

                                    {{-- <div class="rbt-author-meta mb--10">
                                        <div class="rbt-avater">
                                            <a href="#">
                                                <img src="assets/images/client/avatar-02.png" alt="Sophia Jaymes">
                                            </a>
                                        </div>
                                        <div class="rbt-author-info">
                                            By <a href="profile.html">Angela</a> In <a href="#">Development</a>
                                        </div>
                                    </div> --}}
                                    <div class="rbt-card-bottom">
                                        <a class="rbt-btn-link" href="{{ route('subject.details', ['subject_id' =>  encrypt($subject->id), 'teacher_id' =>  encrypt($teacher->id)]) }}">مزيد من المعلومات<i class="feather-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Card  -->
                    @endforeach
                </div>
                <!-- End Card Area -->
            </div>
        </div>
    </div>
</div>

@endsection