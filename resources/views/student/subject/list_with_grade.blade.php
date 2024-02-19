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
                            <li class="rbt-breadcrumb-item active">مواد {{ $grade->name }}</li>
                        </ul>
                        <!-- End Breadcrumb Area  -->

                        <div class=" title-wrapper">
                            <h1 class="title mb--0">{{ $grade->name }}</h1>
                            <a href="#" class="rbt-badge-2">
                                <div class="image">🎉</div> {{ $subjects->count() }} ماده
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
                                {{-- <span class="course-index">Showing 1-9 of 19 results</span> --}}
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-lg-7 col-md-12">
                        <div class="rbt-sorting-list d-flex flex-wrap align-items-center justify-content-start justify-content-lg-end">
                            <div class="rbt-short-item">
                                <form action="#" class="rbt-search-style me-0">
                                    <input type="text" placeholder="Search Your Course..">
                                    <button type="submit" class="rbt-search-btn rbt-round-btn">
                                        <i class="feather-search"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="rbt-short-item">
                                <div class="view-more-btn text-start text-sm-end">
                                    <button class="discover-filter-button discover-filter-activation rbt-btn btn-white btn-md radius-round">Filter<i class="feather-filter"></i></button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <!-- Start Filter Toggle  -->
                <div class="default-exp-wrapper default-exp-expand">
                    <div class="filter-inner">
                        <div class="filter-select-option">
                            <div class="filter-select rbt-modern-select">
                                <span class="select-label d-block">Short By</span>
                                <select>
                                    <option>Default</option>
                                    <option>Latest</option>
                                    <option>Popularity</option>
                                    <option>Trending</option>
                                    <option>Price: low to high</option>
                                    <option>Price: high to low</option>
                                </select>
                            </div>
                        </div>

                        <div class="filter-select-option">
                            <div class="filter-select rbt-modern-select">
                                <span class="select-label d-block">Short By Author</span>
                                <select data-live-search="true" title="Select Author" multiple data-size="7" data-actions-box="true" data-selected-text-format="count > 2">
                                    <option data-subtext="Experts">Janin Afsana</option>
                                    <option data-subtext="Experts">Joe Biden</option>
                                    <option data-subtext="Experts">Fatima Asrafy</option>
                                    <option data-subtext="Experts">Aysha Baby</option>
                                    <option data-subtext="Experts">Mohamad Ali</option>
                                    <option data-subtext="Experts">Jone Li</option>
                                    <option data-subtext="Experts">Alberd Roce</option>
                                    <option data-subtext="Experts">Zeliski Noor</option>
                                </select>
                            </div>
                        </div>

                        <div class="filter-select-option">
                            <div class="filter-select rbt-modern-select">
                                <span class="select-label d-block">Short By Offer</span>
                                <select>
                                    <option>Free</option>
                                    <option>Paid</option>
                                    <option>Premium</option>
                                </select>
                            </div>
                        </div>

                        <div class="filter-select-option">
                            <div class="filter-select rbt-modern-select">
                                <span class="select-label d-block">Short By Category</span>
                                <select data-live-search="true">
                                    <option>Web Design</option>
                                    <option>Graphic</option>
                                    <option>App Development</option>
                                    <option>Figma Design</option>
                                </select>
                            </div>
                        </div>

                        <div class="filter-select-option">
                            <div class="filter-select">
                                <span class="select-label d-block">Price Range</span>

                                <div class="price_filter s-filter clear">
                                    <form action="#" method="GET">
                                        <div id="slider-range"></div>
                                        <div class="slider__range--output">
                                            <div class="price__output--wrap">
                                                <div class="price--output">
                                                    <span>Price :</span><input type="text" id="amount">
                                                </div>
                                                <div class="price--filter">
                                                    <a class="rbt-btn btn-gradient btn-sm" href="#">Filter</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Filter Toggle  -->

                <div class="row mt--60">
                    <div class="col-lg-12">
                        <div class="rbt-portfolio-filter filter-button-default messonry-button text-start justify-content-start">
                            <button data-filter="*" class="is-checked"><span class="filter-text">كل الاقسام</span><span
                                    class="course-number"></span></button>
                            {{-- <button data-filter=".cat--1" class=""><span class="filter-text">Featured</span><span
                                    class="course-number">02</span></button>
                            <button data-filter=".cat--2"><span class="filter-text">Popular</span><span
                                    class="course-number">05</span></button>
                            <button data-filter=".cat--3"><span class="filter-text">Trending</span><span
                                    class="course-number">03</span></button>
                            <button data-filter=".cat--4"><span class="filter-text">Latest</span><span
                                    class="course-number">04</span></button> --}}
                            @foreach($grade->categories as $category) 
                                <button data-filter=".{{$category->id}}" class=""><span class="filter-text">{{ $category->name }}</span><span
                                    class="course-number"></span></button>
                            @endforeach
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
                    @foreach($subjects as $subject)
                        <!-- Start Single Card  -->
                        @php
                            $categories = "";
                            foreach ($subject->grade->categories as $key => $category) {
                                $categories = $categories ." ".$category->id;
                            }
                        @endphp
                        <div class="maso-item {{$categories}}">
                            <div class="rbt-card variation-01 rbt-hover card-list-2">
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
                                        <div class="rbt-price">
                                            <span class="current-price">{{ $subject->recordedLessons->sum('price') }} جنيه</span>
                                        </div>
                                        <a class="rbt-btn-link" href="{{ route('subject.teachers', encrypt($subject->id)) }}">مزيد من المعلومات<i class="feather-arrow-right"></i></a>
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