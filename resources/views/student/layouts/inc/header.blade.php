    <!-- Start Header Area -->
    <header class="rbt-header rbt-header-10">
        <div class="rbt-sticky-placeholder"></div>
        <div class="rbt-header-wrapper header-space-betwween header-sticky">
            <div class="container-fluid">
                <div class="mainbar-row rbt-navigation-center align-items-center">
                    <div class="header-left rbt-header-content">
                        <div class="header-info">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="{{asset('')}}student_assets/images/logo/logo.png" alt="Education Logo Images">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="rbt-main-navigation d-none d-xl-block pt-4 pb-4">
                        <nav class="mainmenu-nav pt-4 pb-4">
                            <ul class="mainmenu pt-4 pb-4">

                            </ul>
                        </nav>
                    </div>

                    <div class="header-right">

                        <!-- Navbar Icons -->
                        <ul class="quick-access">
                            <li class="access-icon">
                                <a class="search-trigger-active rbt-round-btn" href="#">
                                    <i class="feather-search"></i>
                                </a>
                            </li>

                            {{-- <li class="access-icon rbt-mini-cart">
                                <a class="rbt-cart-sidenav-activation rbt-round-btn" href="#">
                                    <i class="feather-shopping-cart"></i>
                                    <span class="rbt-cart-count">4</span>
                                </a>
                            </li> --}}

                            @if(auth()->user() == null)
                                <li class="account-access rbt-user-wrapper d-none d-xl-block">
                                    <a href="{{ route('sigin') }}">تسجيل دخول <i class="feather-user"></i></a>
                                </li>   
                                <div class="rbt-btn-wrapper d-none d-xl-block">
                                    <a class="rbt-btn rbt-marquee-btn marquee-auto btn-border-gradient radius-round btn-sm hover-transform-none" href="{{ route('signup') }}">
                                        <span data-text="تسجيل حساب جديد">تسجيل حساب جديد</span>
                                    </a>
                                </div>

                            @else

                            <li class="account-access rbt-user-wrapper d-none d-xl-block">
                                <a href="#"><i class="feather-user"></i>{{ auth()->user()->name }}</a>
                                <div class="rbt-user-menu-list-wrapper">
                                    <div class="inner">
                                        <div class="rbt-admin-profile">
                                            <div class="admin-thumbnail">
                                                <img src="{{ auth()->user()->getFirstMedia('students') != null ? auth()->user()->getFirstMedia('students')->getUrl() : '' }}" alt="User Images">
                                            </div>
                                            <div class="admin-info">
                                                <span class="name">{{ auth()->user()->name }}</span>
                                                {{-- <a class="rbt-btn-link color-primary" href="profile.html">View Profile</a> --}}
                                            </div>
                                        </div>
                                        <ul class="user-list-wrapper">
                                            <li>
                                                <a href="{{ route('student.dashboard.index') }}">
                                                    <i class="feather-home"></i>
                                                    <span>لوحة التحكم</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <hr class="mt--10 mb--10">
                                        <ul class="user-list-wrapper">
                                            <li>
                                                <a href="{{ route('student.auth.logout') }}">
                                                    <i class="feather-log-out"></i>
                                                    <span>تسجيل خروج</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>

                            @endif

                            @if(auth()->user() != null)
                                <li class="access-icon rbt-user-wrapper d-block d-xl-none">
                                    <a href="#"><i class="feather-user"></i></a>
                                    <div class="rbt-user-menu-list-wrapper">
                                        <div class="inner">
                                            <div class="rbt-admin-profile">
                                                <div class="admin-thumbnail">
                                                    <img src="{{ auth()->user()->getFirstMedia('students') != null ? auth()->user()->getFirstMedia('students')->getUrl() : '' }}" alt="User Images">
                                                </div>
                                                <div class="admin-info">
                                                    <span class="name">{{ auth()->user()->name }}</span>
                                                    {{-- <a class="rbt-btn-link color-primary" href="profile.html">View Profile</a> --}}
                                                </div>
                                            </div>
                                            <ul class="user-list-wrapper">
                                                <li>
                                                    <a href="{{ route('student.dashboard.index') }}">
                                                        <i class="feather-home"></i>
                                                        <span>لوحة التحكم</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <hr class="mt--10 mb--10">
                                            <ul class="user-list-wrapper">
                                                <li>
                                                    <a href="{{ route('student.auth.logout') }}">
                                                        <i class="feather-log-out"></i>
                                                        <span>تسجيل خروج</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endif

                        </ul>

                        <!-- Start Mobile-Menu-Bar -->
                        <div class="mobile-menu-bar d-block d-xl-none">
                            <div class="hamberger">
                                <button class="hamberger-button rbt-round-btn">
                                    <i class="feather-menu"></i>
                                </button>
                            </div>
                        </div>
                        <!-- Start Mobile-Menu-Bar -->

                    </div>
                </div>
            </div>
            <!-- Start Search Dropdown  -->
            <div class="rbt-search-dropdown">
                <div class="wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="#">
                                <input type="text" placeholder="اكتب اسم االماده المراد البحث عنها">
                                <div class="submit-btn">
                                    <a class="rbt-btn btn-gradient btn-md" href="#">بحث</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="rbt-separator-mid">
                        <hr class="rbt-separator m-0">
                    </div>

                </div>
            </div>
            <!-- End Search Dropdown  -->
        </div>
        <a class="rbt-close_side_menu" href="javascript:void(0);"></a>
    </header>