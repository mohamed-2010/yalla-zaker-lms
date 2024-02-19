@extends('student.layouts.app')

@section('meta_title')
    تفاصيل الماده
@endsection

@section('content')

<div class="rbt-page-banner-wrapper">
    <!-- Start Banner BG Image  -->
    <div class="rbt-banner-image"></div>
    <!-- End Banner BG Image  -->
    <div class="rbt-banner-content">
        <!-- Start Banner Content Top  -->
        <div class="rbt-banner-content-top rbt-breadcrumb-style-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 offset-lg-2">
                        <div class="content text-center">

                            <div class="d-flex align-items-center flex-wrap justify-content-center mb--15 rbt-course-details-feature">
                                <div class="feature-sin best-seller-badge">
                                    <span class="rbt-badge-2">
                                            <span class="image"><img src="{{asset('')}}student_assets/images/icons/card-icon-1.png"
                                                    alt="Best Seller Icon"></span> Bestseller
                                    </span>
                                </div>
                            </div>
                            <h2 class="title theme-gradient">{{ $subject->name }}</h2>

                            <ul class="rbt-meta">
                                <li><i class="feather-calendar"></i>{{ $subject->grade->name }}</li>
                                <li><i class="feather-award"></i>{{ $teacher->name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner Content Top  -->
    </div>
</div>

<div class="rbt-section-overlayping-top rbt-section-gapBottom">
    <div class="inner">
        <div class="container">
            <div class="col-lg-12">
                <!-- Start Viedo Wrapper  -->
                <a class="video-popup-with-text video-popup-wrapper text-center popup-video mb--15">
                    <div class="video-content">
                        <img class="w-100 rbt-radius" src="{{ $subject->getFirstMedia('subjects') != null ? $subject->getFirstMedia('subjects')->getUrl() : "" }}" alt="Video Images">
                    </div>
                </a>
                <!-- End Viedo Wrapper  -->

                <div class="row row--30 gy-5 pt--60">

                    <div class="col-lg-4">
                        <div class="course-sidebar sticky-top rbt-shadow-box rbt-gradient-border">
                            <div class="inner">
                                <div class="content-item-content">
                                    <div class="rbt-price-wrapper d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="rbt-price">
                                            <span class="current-price">{{ $subject->recordedLessons->sum('price') }} جنيه</span>
                                        </div>
                                    </div>

                                    <div class="buy-now-btn mt--15">
                                        <a class="rbt-btn btn-border icon-hover w-100 d-block text-center" href="#">
                                            <span class="btn-text">شراء الان</span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                        </a>
                                    </div>

                                    {{-- <div class="rbt-widget-details has-show-more">
                                        <ul class="has-show-more-inner-content rbt-course-details-list-wrapper">
                                            <li><span>Enrolled</span><span class="rbt-feature-value rbt-badge-5">100</span></li>
                                            <li><span>Lectures</span><span class="rbt-feature-value rbt-badge-5">50</span></li>
                                            <li><span>Skill Level</span><span class="rbt-feature-value rbt-badge-5">Basic</span></li>
                                            <li><span>Language</span><span class="rbt-feature-value rbt-badge-5">English</span></li>
                                            <li><span>Quizzes</span><span class="rbt-feature-value rbt-badge-5">10</span></li>
                                            <li><span>Certificate</span><span class="rbt-feature-value rbt-badge-5">Yes</span></li>
                                            <li><span>Pass Percentage</span><span class="rbt-feature-value rbt-badge-5">95%</span></li>
                                        </ul>
                                        <div class="rbt-show-more-btn">Show More</div>
                                    </div> --}}

                                    {{-- <div class="social-share-wrapper mt--30 text-center">
                                        <div class="rbt-post-share d-flex align-items-center justify-content-center">
                                            <ul class="social-icon social-default transparent-with-border justify-content-center">
                                                <li><a href="https://www.facebook.com/">
                                                        <i class="feather-facebook"></i>
                                                    </a>
                                                </li>
                                                <li><a href="https://www.twitter.com">
                                                        <i class="feather-twitter"></i>
                                                    </a>
                                                </li>
                                                <li><a href="https://www.instagram.com/">
                                                        <i class="feather-instagram"></i>
                                                    </a>
                                                </li>
                                                <li><a href="https://www.linkdin.com/">
                                                        <i class="feather-linkedin"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <hr class="mt--20">
                                        <div class="contact-with-us text-center">
                                            <p>For details about the course</p>
                                            <p class="rbt-badge-2 mt--10 justify-content-center w-100"><i class="feather-phone mr--5"></i> Call Us: <a href="#"><strong>+444 555 666 777</strong></a></p>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <!-- Start Course Details  -->
                        <div class="course-details-content">
                            {{-- <div class="rbt-inner-onepage-navigation sticky-top">
                                <nav class="mainmenu-nav onepagenav">
                                    <ul class="mainmenu">
                                        <li class="current">
                                            <a href="#overview">Overview</a>
                                        </li>
                                        <li>
                                            <a href="#coursecontent">Course Content</a>
                                        </li>
                                        <li>
                                            <a href="#details">Details</a>
                                        </li>
                                        <li>
                                            <a href="#intructor">Intructor</a>
                                        </li>
                                        <li>
                                            <a href="#review">Review</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div> --}}

                            <!-- Start Course Content  -->
                            <div class="course-content rbt-shadow-box coursecontent-wrapper mt--30" id="coursecontent">
                                <div class="rbt-course-feature-inner">
                                    <div class="section-title">
                                        <h4 class="rbt-title-style-3">الدروس</h4>
                                    </div>
                                    <div class="rbt-accordion-style rbt-accordion-02 accordion">
                                        <div class="accordion" id="accordionExampleb2">

                                            <div class="accordion-body card-body pr--0">
                                                <ul class="rbt-course-main-content liststyle">
                                                    {{-- @dd($subject->recordedLessons) --}}
                                                    @foreach($subject->recordedLessons as $recordedLesson)
                                                        @if($recordedLesson->is_paid == 0)
                                                            <li>
                                                                <a>
                                                                    <div class="course-content-left">
                                                                        <i class="feather-play-circle"></i> <span
                                                                                class="text">{{ $recordedLesson->name }}</span>
                                                                    </div>
                                                                    <div class="course-content-right">
                                                                        {{-- <span class="min-lable">30 min</span> --}}
                                                                        <span class="rbt-badge variation-03 bg-primary-opacity"><i class="feather-eye"></i> عرض</span>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a>
                                                                    <div class="course-content-left">
                                                                        <i class="feather-play-circle"></i> <span
                                                                                class="text">{{ $recordedLesson->name }}</span>
                                                                    </div>
                                                                    <div class="course-content-right">
                                                                        {{-- <span class="course-lock"><i class="feather-lock"></i></span> --}}
                                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#purchaseLectureModal-{{$recordedLesson->id}}">
                                                                            شراء المحاضرة
                                                                        </button>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Course Content  -->
                        </div>
                        <!-- End Course Details  -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($subject->recordedLessons as $recordedLesson)
    <!-- Modal -->
    <div class="modal fade" id="purchaseLectureModal-{{ $recordedLesson->id }}" tabindex="-1" aria-labelledby="purchaseLectureModalLabel-{{ $recordedLesson->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h5 class="modal-title" id="purchaseLectureModalLabel">شراء المحاضرة</h5>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if(auth()->user() != null)
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <strong>{{ $recordedLesson->name }}</strong>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input payment-type" type="radio" name="paymentType-{{ $recordedLesson->id }}" id="balance-{{ $recordedLesson->id }}" value="balance" checked>
                                <label class="form-check-label" for="balance-{{ $recordedLesson->id }}">
                                    محفظة الحساب
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input payment-type" type="radio" name="paymentType-{{ $recordedLesson->id }}" id="coupon-{{ $recordedLesson->id }}" value="coupon">
                                <label class="form-check-label" for="coupon-{{ $recordedLesson->id }}">
                                    كوبون
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input payment-type" type="radio" name="paymentType-{{ $recordedLesson->id }}" id="fawry-{{ $recordedLesson->id }}" value="fawry">
                                <label class="form-check-label" for="fawry-{{ $recordedLesson->id }}">
                                    فوري
                                </label>
                            </div>
                        </div>
                        <div class="text-center my-4 mx-4" id="balance-content-{{ $recordedLesson->id }}">
                            <div>
                                <strong>رصيد المحفظة: 0.00 جنيه</strong><br>
                                <a href="/wallet?recharge=1" class="btn btn-outline-danger mt-3">شحن رصيد المحفظة</a>
                                <div class="text-center">
                                    <div class="details-text muted--text mb-2">سيتم خصم المبلغ التالي من رصيد محفظتك:</div>
                                    <div class="strong-text--text" style="font-size: 1.5rem;">{{ $recordedLesson->price }}.00 <span class="medium-text muted--text">جنيه</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center my-4 mx-4" id="coupon-content-{{ $recordedLesson->id }}" style="display: none;">
                            <div class="form-group">
                                <input name="code" id="coupon-input-{{ $recordedLesson->id }}" type="text" />
                                <label>ادخل الكود  *</label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div id="fawry-content-{{ $recordedLesson->id }}" style="display: none;">
                            <!-- Fawry content goes here -->
                        </div> 
                    </div>
                @else
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <strong>يجب تسجيل الدخول اولا</strong>
                        </div>
                    </div>
                @endif
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    @if(auth()->user() != null)
                    <button type="button" class="btn btn-primary" id="purchase-button-{{ $recordedLesson->id }}" disabled>إتمام الشراء</button>
                    @else
                        <a href="{{ route('sigin') }}" class="btn btn-primary">تسجيل دخول</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection

@push('scripts')

    
<script>
    $(document).ready(function() {
        // $('.payment-type').change(function() {
        //     var paymentType = $(this).val();
        //     var recordedLessonId = $(this).attr('name').split('-')[1];
        //     if (paymentType === 'coupon') {
        //         $('#coupon-content-' + recordedLessonId).show();
        //         $('#purchase-button-' + recordedLessonId).prop('disabled', true);
        //     } else {
        //         $('#coupon-content-' + recordedLessonId).hide();
        //         $('#purchase-button-' + recordedLessonId).prop('disabled', false);
        //     }
        // });
        $('#coupon-input-{{ $recordedLesson->id }}').change(function() {
            var coupon = $(this).val();
            var recordedLessonId = $(this).attr('id').split('-')[2];
            if (coupon) {
                $('#purchase-button-' + recordedLessonId).prop('disabled', false);
            } else {
                $('#purchase-button-' + recordedLessonId).prop('disabled', true);
            }
        });
        $('#purchase-button-{{ $recordedLesson->id }}').click(function() {
            var coupon = $('#coupon-input-{{ $recordedLesson->id }}').val();
            if (coupon) {
                $.ajax({
                    url: "{{ route('student.dashboard.lesson.buy_with_coupone') }}",
                    type: "POST",
                    data: {
                        "coupone": coupon,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            }
        });
    });
</script>

@endpush