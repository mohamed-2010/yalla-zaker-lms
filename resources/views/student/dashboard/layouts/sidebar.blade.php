<!-- Start Dashboard Sidebar  -->
<div class="rbt-default-sidebar sticky-top rbt-shadow-box rbt-gradient-border">
    <div class="inner">
        <div class="content-item-content">

            <div class="rbt-default-sidebar-wrapper">
                <div class="section-title mb--20">
                    <h6 class="rbt-title-style-2">مرحبا، {{ auth()->user()->name }}</h6>
                </div>
                <nav class="mainmenu-nav">
                    <ul class="dashboard-mainmenu rbt-default-sidebar-list">
                        <li><a href="{{ route('student.dashboard.index') }}"><i class="feather-home"></i><span>لوحة التحكم</span></a></li>
                        <li><a href="{{ route('student.dashboard.profile') }}"><i class="feather-user"></i><span>حسابي</span></a></li>
                        {{-- <li><a href="student-enrolled-courses.html"><i class="feather-book-open"></i><span>Enrolled Courses</span></a></li>
                        <li><a href="student-wishlist.html"><i class="feather-bookmark"></i><span>Wishlist</span></a></li>
                        <li><a href="student-reviews.html"><i class="feather-star"></i><span>Reviews</span></a></li>
                        <li><a href="student-my-quiz-attempts.html"><i class="feather-help-circle"></i><span>My Quiz Attempts</span></a></li> --}}
                        <li><a href="student-order-history.html"><i class="feather-shopping-bag"></i><span>السجل</span></a></li>
                    </ul>
                </nav>

                <div class="section-title mt--40 mb--20">
                    <h6 class="rbt-title-style-2">التحكم</h6>
                </div>

                <nav class="mainmenu-nav">
                    <ul class="dashboard-mainmenu rbt-default-sidebar-list">
                        <li><a href="{{ route('student.dashboard.settings') }}"><i class="feather-settings"></i><span>الاعدادات</span></a></li>
                        <li><a href="{{ route('student.auth.logout') }}"><i class="feather-log-out"></i><span>تسجيل خروج</span></a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>
<!-- End Dashboard Sidebar  -->