@extends('student.dashboard.layouts.main')

@section('body')

<div class="col-lg-9">
    <div class="rbt-dashboard-content bg-color-white rbt-shadow-box mb--60">
        <div class="content">
            <div class="section-title">
                <h4 class="rbt-title-style-3">معلومات</h4>
            </div>
            <div class="row g-5">

                <!-- Start Single Card  -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="rbt-counterup variation-01 rbt-hover-03 rbt-border-dashed bg-primary-opacity">
                        <div class="inner">
                            <div class="rbt-round-icon bg-primary-opacity">
                                <i class="feather-book-open"></i>
                            </div>
                            <div class="content">
                                <h3 class="counter without-icon color-primary"><span class="odometer" data-count="{{ $available_videos }}">{{ $available_videos }}</span>
                                </h3>
                                <span class="rbt-title-style-2 d-block">الدروس المتاحه</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Card  -->

                <!-- Start Single Card  -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="rbt-counterup variation-01 rbt-hover-03 rbt-border-dashed bg-secondary-opacity">
                        <div class="inner">
                            <div class="rbt-round-icon bg-secondary-opacity">
                                <i class="feather-monitor"></i>
                            </div>
                            <div class="content">
                                <h3 class="counter without-icon color-secondary"><span class="odometer" data-count="{{ $authed_devices }}">{{ $authed_devices }}</span>
                                </h3>
                                <span class="rbt-title-style-2 d-block">الاجهزه المسجل عليها</span>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End Single Card  -->

                <!-- Start Single Card  -->
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="rbt-counterup variation-01 rbt-hover-03 rbt-border-dashed bg-violet-opacity">
                        <div class="inner">
                            <div class="rbt-round-icon bg-violet-opacity">
                                <i class="feather-award"></i>
                            </div>
                            <div class="content">
                                <h3 class="counter without-icon color-violet"><span class="odometer" data-count="{{ $wallet_balance }}">{{ $wallet_balance }}</span>
                                </h3>
                                <span class="rbt-title-style-2 d-block">رصيد المحفظه</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Card  -->

            </div>
        </div>
    </div>
</div>

@endsection