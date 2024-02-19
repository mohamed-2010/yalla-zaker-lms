@extends('student.layouts.app')

@section('meta_title')
    
@endsection

@section('content')

    <main class="rbt-main-wrapper">
        <!-- Start Banner Area -->
        <div class="rbt-banner-area rbt-banner-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 pb--120 pt--70">
                        <div class="content">
                            <div class="inner">
                                <div class="rbt-new-badge rbt-new-badge-one">
                                    <span class="rbt-new-badge-icon">🏆</span> الزعيم هو التعلم عبر الانترنت
                                </div>

                                <h1 class="title">
                                    ابني مهارات <br> لكي تقود كاريرك.
                                </h1>
                                <p class="description">
                                    مع مجموعة متنوعة من الدورات التدريبية والتعليمية المتاحة لك، يمكنك تعلم مهارات جديدة وتطوير مهاراتك الحالية.
                                </p>
                                <div class="slider-btn">
                                    <a class="rbt-btn btn-gradient hover-icon-reverse" href="#">
                                        <span class="icon-reverse-wrapper">
                                            <span class="btn-text">الدروس</span>
                                        <span class="btn-icon"><i class="feather-arrow-left"></i></span>
                                        <span class="btn-icon"><i class="feather-arrow-left"></i></span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="shape-wrapper" id="scene">
                                <img src="{{asset('')}}student_assets/images/banner/banner-01.png" alt="Hero Image">
                                <div class="hero-bg-shape-1 layer" data-depth="0.4">
                                    <img src="{{asset('')}}student_assets/images/shape/shape-01.png" alt="Hero Image Background Shape">
                                </div>
                                <div class="hero-bg-shape-2 layer" data-depth="0.4">
                                    <img src="{{asset('')}}student_assets/images/shape/shape-02.png" alt="Hero Image Background Shape">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner Area -->

        <div class="rbt-categories-area bg-color-white rbt-section-gapBottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <span class="subtitle bg-primary-opacity">المراحل الدراسيه</span>
                            <h2 class="title">اكتشف المراحل الدارسيه</h2>
                        </div>
                    </div>
                </div>
                <div class="row g-5 mt--20">
                    @foreach($grades as $grade)
                        <!-- Start Category Box Layout  -->
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12 my-2">
                            <a class="rbt-cat-box rbt-cat-box-1 text-center" href="{{ route('subjects.get_subjects_with_grade', encrypt($grade->id)) }}">
                                <div class="inner">
                                    <div class="icons">
                                        <img src="{{ $grade->getFirstMedia('grades') != null ? $grade->getFirstMedia('grades')->getUrl() : "" }}" alt="Icons Images">
                                    </div>
                                    <div class="content">
                                        <h5 class="title">{{ $grade->name }}</h5>
                                        <div class="read-more-btn">
                                            <span class="rbt-btn-link">{{ $grade->subjects->count() }} ماده<i class="feather-arrow-left"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- End Category Box Layout  -->
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Start Teacher Area -->
        <div class="rbt-newsletter-area newsletter-style-2 bg-color-primary rbt-section-gap">
            <div class="container">
                <div class="row row--15 align-items-center">
                    <div class="col-lg-12">
                        <div class="inner text-center">
                            <div class="section-title text-center">
                                <span class="subtitle bg-white-opacity">المدرسين</span>
                                <h2 class="title color-white"><strong>اكتشف جميع المدرسين</h2>
                            </div>
                            <div class="row row--15 mt--50">
                                @foreach($teachers as $teacher)
                                    <!-- Start Category Box Layout  -->
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 my-2">
                                        <a class="rbt-cat-box rbt-cat-box-1 text-center" href="{{ route('teacher.details', encrypt($teacher->id)) }}">
                                            <div class="inner">
                                                <div class="icons">
                                                    <img src="{{ $teacher->getFirstMedia('teachers') != null ? $teacher->getFirstMedia('teachers')->getUrl() : "" }}" alt="Icons Images">
                                                </div>
                                                <div class="content">
                                                    <h5 class="title">{{ $teacher->name }}</h5>
                                                    <div class="read-more-btn">
                                                        <span class="rbt-btn-link">{{ $teacher->subjects->count() }} ماده<i class="feather-arrow-left"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <!-- End Category Box Layout  -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Teacher Area -->

        <!-- Start Course Area -->
        <div class="rbt-course-area bg-color-extra2 rbt-section-gap">
            <div class="container">
                <div class="row mb--60">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <span class="subtitle bg-secondary-opacity">المواد</span>
                            <h2 class="title">اكتشف حميع المواد</h2>
                        </div>
                    </div>
                </div>
                <!-- Start Card Area -->
                <div class="row g-5">
                    @foreach($subjects as $subject)
                        <!-- Start Single Course  -->
                        <div class="col-lg-4 col-md-6 col-12 my-2">
                            <div class="rbt-card variation-01 rbt-hover">
                                <div class="rbt-card-img">
                                    <a href="{{ route('subject.teachers', encrypt($subject->id)) }}">
                                        <img src="{{ $subject->getFirstMedia('subjects') != null ? $subject->getFirstMedia('subjects')->getUrl() : "" }}" alt="Card image">
                                    </a>
                                </div>
                                <div class="rbt-card-body">
                                    <h4 class="rbt-card-title"><a href="{{ route('subject.teachers', encrypt($subject->id)) }}">{{ $subject->name }}</a>
                                    </h4>
                                    <ul class="rbt-meta">
                                        <li><i class="feather-book"></i>{{ $subject->recordedLessons->count() }} درس</li>
                                    </ul>

                                    <div class="rbt-card-bottom">
                                        <div class="rbt-price">
                                            @php
                                                $price = $subject->recordedLessons->sum('price');
                                            @endphp
                                            <span class="current-price">{{ $price }} جنيه</span>
                                        </div>
                                        {{-- <a class="rbt-btn-link" href="course-details.html">Learn
                                            More<i class="feather-arrow-right"></i></a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Course  -->
                    @endforeach
                </div>
                <!-- End Card Area -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="load-more-btn mt--60 text-center">
                            <a class="rbt-btn btn-gradient btn-lg hover-icon-reverse" href="#">
                                <span class="icon-reverse-wrapper">
                                    <span class="btn-text">عرض المزيد من المواد</span>
                                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Course Area -->

    </main>

@endsection

@push('scripts')

<script>

</script>

@endpush