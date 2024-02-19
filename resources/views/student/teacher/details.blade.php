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
                        <div class="tutor-bg-photo bg_image bg_image--22 height-350" style="background-image: url('{{ $teacher->getFirstMedia('teachers_cover') != null ? $teacher->getFirstMedia('teachers_cover')->getUrl() : asset('../images/bg/bg-image-22.jpg') }}');">
                            {{-- <img src="{{ $teacher->getFirstMedia('teachers_cover') != null ? $teacher->getFirstMedia('teachers_cover')->getUrl() : ""  }}" alt=""> --}}
                        </div>
                        <!-- Start Tutor Information  -->
                        <div class="rbt-tutor-information">
                            <div class="rbt-tutor-information-left">
                                <div class="thumbnail rbt-avatars size-lg">
                                    <img src="{{ $teacher->getFirstMedia('teachers') != null ? $teacher->getFirstMedia('teachers')->getUrl() : asset('').'student_assets/images/team/avatar.jpg' }}" alt="Instructor">
                                </div>
                                <div class="tutor-content">
                                    <h5 class="title">{{ $teacher->name }}</h5>
                                    <ul class="rbt-meta rbt-meta-white mt--5">
                                        <li><i class="feather-book"></i>{{ $teacher->subjects->count() }} ماده</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End Tutor Information  -->
                    </div>
                    <!-- End Dashboard Top  -->
                </div>
                <div class="col-lg-12 mt--30">
                    <div class="profile-content rbt-shadow-box">
                        <h4 class="rbt-title-style-3">السيره</h4>
                        <div class="row g-5">
                            <div class="col-lg-8">
                                <p class="mt--10 mb--20">{{ $teacher->bio }}</p>
                                <ul class="social-icon social-default justify-content-start">
                                    @if(strlen($teacher->fb_url) > 6)
                                    <li><a href="{{ $teacher->fb_url }}">
                                            <i class="feather-facebook"></i>
                                        </a>
                                    </li>
                                    @endif
                                    @if(strlen($teacher->tk_url) > 6)
                                    <li><a href="{{$teacher->tk_url}}">
                                            <i class="feather-tiktok">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none">
                                                    <path d="M12.95.02C14.26 0 15.56.01 16.86 0c.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07Z" fill="currentColor" />
                                                </svg>
                                            </i>
                                        </a>
                                    </li>
                                    @endif
                                    @if(strlen($teacher->insta_url) > 6)
                                    <li><a href="{{$teacher->insta_url}}">
                                            <i class="feather-instagram"></i>
                                        </a>
                                    </li>
                                    @endif
                                    @if(strlen($teacher->yt_url) > 6)
                                    <li>
                                        <a href="{{ $teacher->yt_url }}">
                                            <i class="feather-youtube"></i>
                                        </a>
                                    </li>
                                    @endif
                                    @if(strlen($teacher->whatsapp_1) > 6)
                                    <li>
                                        <a href="{{ $teacher->whatsapp_1 }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none">
                                                <path d="M6.579 8.121c.209-.663.778-1.457 1.19-1.66.183-.09.319-.11.763-.11.522 0 .548.005.684.14.088.095.328.606.673 1.432.292.71.533 1.315.533 1.347 0 .146-.293.61-.627 1.002-.23.267-.365.47-.365.543 0 .068.167.381.376.69.506.757 1.44 1.696 2.167 2.177.568.376 1.582.867 1.785.867.152 0 .429-.272.992-.982.23-.287.434-.495.512-.511.068-.021.235.005.37.057.392.152 2.371 1.117 2.476 1.211.203.188.037 1.264-.267 1.702-.464.68-1.79 1.259-2.663 1.17-.636-.068-2.14-.564-3.117-1.029-1.253-.6-2.574-1.697-3.644-3.038-.611-.763-1.227-1.692-1.493-2.246-.36-.751-.491-1.331-.455-2 .016-.287.068-.631.11-.762Z" fill="currentColor" />
                                                <path clip-rule="evenodd" d="M.606 9.5C1.582 4.491 5.576.76 10.709.06c.705-.1 2.684-.068 3.368.046.715.126 1.66.371 2.24.59 3.832 1.426 6.663 4.72 7.466 8.683.35 1.729.272 3.755-.203 5.457-1.133 4.03-4.423 7.205-8.511 8.218-2.663.658-5.462.37-7.983-.81l-.617-.292-3.226 1.029C1.473 23.545.01 23.994 0 23.983c-.01-.01.45-1.415 1.029-3.112l1.05-3.096-.424-.84C.48 14.569.12 12.01.605 9.498Zm21.172-.408c-1.028-3.76-4.297-6.626-8.145-7.148-2.099-.282-4.078.037-5.9.956-4.417 2.234-6.522 7.341-4.93 11.957.204.59.752 1.702 1.092 2.213l.271.408-.605 1.775a69.688 69.688 0 0 0-.606 1.817c0 .026.84-.224 1.864-.548a99.767 99.767 0 0 1 1.9-.596c.022 0 .225.11.45.24 2.428 1.447 5.456 1.76 8.187.852a9.927 9.927 0 0 0 6.48-6.945 9.998 9.998 0 0 0-.058-4.98Z" fill="currentColor" fill-rule="evenodd" />
                                                <!-- Number 1 -->
                                                <text x="4" y="7" fill="currentColor" font-size="4">1</text>
                                            </svg>                                              
                                        </a>
                                    </li>
                                    @endif
                                    @if(strlen($teacher->whatsapp_2) > 6)
                                    <li>
                                        <a href="{{ $teacher->whatsapp_2 }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none">
                                                <path d="M6.579 8.121c.209-.663.778-1.457 1.19-1.66.183-.09.319-.11.763-.11.522 0 .548.005.684.14.088.095.328.606.673 1.432.292.71.533 1.315.533 1.347 0 .146-.293.61-.627 1.002-.23.267-.365.47-.365.543 0 .068.167.381.376.69.506.757 1.44 1.696 2.167 2.177.568.376 1.582.867 1.785.867.152 0 .429-.272.992-.982.23-.287.434-.495.512-.511.068-.021.235.005.37.057.392.152 2.371 1.117 2.476 1.211.203.188.037 1.264-.267 1.702-.464.68-1.79 1.259-2.663 1.17-.636-.068-2.14-.564-3.117-1.029-1.253-.6-2.574-1.697-3.644-3.038-.611-.763-1.227-1.692-1.493-2.246-.36-.751-.491-1.331-.455-2 .016-.287.068-.631.11-.762Z" fill="currentColor" />
                                                <path clip-rule="evenodd" d="M.606 9.5C1.582 4.491 5.576.76 10.709.06c.705-.1 2.684-.068 3.368.046.715.126 1.66.371 2.24.59 3.832 1.426 6.663 4.72 7.466 8.683.35 1.729.272 3.755-.203 5.457-1.133 4.03-4.423 7.205-8.511 8.218-2.663.658-5.462.37-7.983-.81l-.617-.292-3.226 1.029C1.473 23.545.01 23.994 0 23.983c-.01-.01.45-1.415 1.029-3.112l1.05-3.096-.424-.84C.48 14.569.12 12.01.605 9.498Zm21.172-.408c-1.028-3.76-4.297-6.626-8.145-7.148-2.099-.282-4.078.037-5.9.956-4.417 2.234-6.522 7.341-4.93 11.957.204.59.752 1.702 1.092 2.213l.271.408-.605 1.775a69.688 69.688 0 0 0-.606 1.817c0 .026.84-.224 1.864-.548a99.767 99.767 0 0 1 1.9-.596c.022 0 .225.11.45.24 2.428 1.447 5.456 1.76 8.187.852a9.927 9.927 0 0 0 6.48-6.945 9.998 9.998 0 0 0-.058-4.98Z" fill="currentColor" fill-rule="evenodd" />
                                                <!-- Number 1 -->
                                                <text x="4" y="7" fill="currentColor" font-size="4">2</text>
                                            </svg>  
                                        </a>
                                    </li>
                                    @endif
                                    @if(strlen($teacher->whatsapp_3) > 6)
                                    <li>
                                        <a href="{{ $teacher->whatsapp_3 }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none">
                                                <path d="M6.579 8.121c.209-.663.778-1.457 1.19-1.66.183-.09.319-.11.763-.11.522 0 .548.005.684.14.088.095.328.606.673 1.432.292.71.533 1.315.533 1.347 0 .146-.293.61-.627 1.002-.23.267-.365.47-.365.543 0 .068.167.381.376.69.506.757 1.44 1.696 2.167 2.177.568.376 1.582.867 1.785.867.152 0 .429-.272.992-.982.23-.287.434-.495.512-.511.068-.021.235.005.37.057.392.152 2.371 1.117 2.476 1.211.203.188.037 1.264-.267 1.702-.464.68-1.79 1.259-2.663 1.17-.636-.068-2.14-.564-3.117-1.029-1.253-.6-2.574-1.697-3.644-3.038-.611-.763-1.227-1.692-1.493-2.246-.36-.751-.491-1.331-.455-2 .016-.287.068-.631.11-.762Z" fill="currentColor" />
                                                <path clip-rule="evenodd" d="M.606 9.5C1.582 4.491 5.576.76 10.709.06c.705-.1 2.684-.068 3.368.046.715.126 1.66.371 2.24.59 3.832 1.426 6.663 4.72 7.466 8.683.35 1.729.272 3.755-.203 5.457-1.133 4.03-4.423 7.205-8.511 8.218-2.663.658-5.462.37-7.983-.81l-.617-.292-3.226 1.029C1.473 23.545.01 23.994 0 23.983c-.01-.01.45-1.415 1.029-3.112l1.05-3.096-.424-.84C.48 14.569.12 12.01.605 9.498Zm21.172-.408c-1.028-3.76-4.297-6.626-8.145-7.148-2.099-.282-4.078.037-5.9.956-4.417 2.234-6.522 7.341-4.93 11.957.204.59.752 1.702 1.092 2.213l.271.408-.605 1.775a69.688 69.688 0 0 0-.606 1.817c0 .026.84-.224 1.864-.548a99.767 99.767 0 0 1 1.9-.596c.022 0 .225.11.45.24 2.428 1.447 5.456 1.76 8.187.852a9.927 9.927 0 0 0 6.48-6.945 9.998 9.998 0 0 0-.058-4.98Z" fill="currentColor" fill-rule="evenodd" />
                                                <!-- Number 1 -->
                                                <text x="4" y="7" fill="currentColor" font-size="4">3</text>
                                            </svg>  
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                                <ul class="rbt-information-list mt--15">
                                    <li>
                                        <a href="#"><i class="feather-phone"></i>{{ $teacher->phone }}</a>
                                    </li>
                                    <li>
                                        <a href="mailto:hello@example.com"><i class="feather-mail"></i>{{ $teacher->email }}</a>
                                    </li>
                                </ul>
                            </div>
                            {{-- <div class="col-lg-2 offset-lg-2 mr-16">
                                <div class="feature-sin best-seller-badge text-end h-100">
                                    <span class="rbt-badge-2 w-100 text-center badge-full-height">
                                        <span class="image"><img src="{{asset('')}}student_assets/images/icons/card-icon-1.png" alt="Best Seller Icon"></span> Bestseller
                                    </span>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Start Card Area -->
            <div class="rbt-profile-course-area mt--60">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sction-title">
                            <h2 class="rbt-title-style-3">المواد</h2>
                        </div>
                    </div>
                </div>
                <div class="row g-5 mt--5">
                    @foreach($teacher->subjects as $subject)
                        <!-- Start Single Course  -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="rbt-card variation-01 rbt-hover">
                                <div class="rbt-card-img">
                                    <a href="{{ route('subject.details', ['teacher_id' => encrypt($teacher->id), 'subject_id' => encrypt($subject->id)]) }}">
                                        <img src="{{ $subject->getFirstMedia('subjects') != null ? $subject->getFirstMedia('subjects')->getUrl() : "" }}" alt="Card image">
                                    </a>
                                </div>
                                <div class="rbt-card-body">
                                    <h4 class="rbt-card-title"><a href="{{ route('subject.details', ['teacher_id' => encrypt($teacher->id), 'subject_id' => encrypt($subject->id)]) }}">{{ $subject->name }}</a>
                                    </h4>
                                    <ul class="rbt-meta">
                                        <li><i class="feather-book"></i>{{ $subject->recordedLessons->count() }} درس</li>
                                    </ul>
                                    <div class="rbt-author-meta mb--20">
                                        <div class="rbt-avater">
                                            <a href="#">
                                                <img src="{{asset('')}}student_assets/images/client/avater-01.png" alt="Sophia Jaymes">
                                            </a>
                                        </div>
                                        <div class="rbt-author-info">
                                            بواسطة <a href="">{{ $subject->teachers[0]->name }}</a>
                                        </div>
                                    </div>

                                    <div class="rbt-card-bottom">
                                        <div class="rbt-price">
                                            @php
                                                $price = $subject->recordedLessons->sum('price');
                                            @endphp
                                            <span class="current-price">{{ $price }} جنيه</span>
                                        </div>
                                        <a class="rbt-btn-link" href="{{ route('subject.details', ['teacher_id' => encrypt($teacher->id), 'subject_id' => encrypt($subject->id)]) }}">مزيد من المعلومات<i class="feather-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Course  -->
                    @endforeach
                </div>
            </div>
            <!-- End Card Area -->

            {{-- <div class="row">
                <div class="col-lg-12 mt--60">
                    <nav>
                        <ul class="rbt-pagination">
                            <li><a href="#" aria-label="Previous"><i class="feather-chevron-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#" aria-label="Next"><i class="feather-chevron-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div> --}}
        </div>
    </div>
    <!-- End Card Style -->
    <div class="rbt-separator-mid">
        <div class="container">
            <hr class="rbt-separator m-0">
        </div>
    </div>

@endsection

@push('scripts')

<script>

</script>

@endpush