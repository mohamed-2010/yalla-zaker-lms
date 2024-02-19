<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- font cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('web')}}/css/all.min.css">
    <!-- font cairo -->

    <!-- <link rel="stylesheet" href="{{asset('web')}}/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="{{asset('web')}}/css/bootstrap.rtl.min.css">
    <!-- <link rel="stylesheet" href="{{asset('web')}}/css/app.min.css"> -->

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous"> -->
   <!-- owl -->
   <link rel="shortcut icon" type="image/x-icon" href="{{asset('web')}}/img/favicon.ico">
   <link rel="stylesheet" href="{{asset('web')}}/css/owl.carousel.min.css" />
   <link rel="stylesheet" href="{{asset('web')}}/css/owl.theme.default.min.css" />
   <!-- owl -->
    <!-- style main -->
    <link rel="stylesheet" href="{{asset('web')}}/css/styleTRL.css">
    <link rel="stylesheet" href="{{asset('web')}}/css/style.css">
    <!-- style main -->
    <title>Education</title>
</head>

<body>
    <!--start navbar -->
    <div class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light  navbar-default bg-darked fixed-top stylelogin indexheaders">
                <div class="container-fluid lmsnav">
                    <a class="navbar-brand LMSlogo" href="{{ route('index') }}">
                        <img class="imagelogos" src="{{asset('web')}}/image/logo.png" alt=""/>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 navbarlsm navbarlogin">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('index') }}">الرئيسية</a>
                            </li>
                            <li class="nav-item">
                                                                <a class="nav-link" href="{{route('about-us')}}">المميزات</a>

                            </li>
                                     <li class="nav-item">
                                <a class="nav-link" href="newing.html">الاخبار</a>
                            </li>
                            <li class="nav-item">
<a class="nav-link" href="{{ route('services') }}">خدماتي</a>                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">تواصل معنا</a>
                            </li>
                        </ul>
                        <div class="buttonheader me-auto">
                            <span class="register">
                                <a href="{{ route('student.login') }}" class="register">تسجيل دخول</a>
                            </span>
                            <i class="fas fa-arrow-left 2x arrowstart"></i>
                            <!-- <button type="button" class="btn btn-primary  startnow"
                                autocomplete="off">
                                <a href="{{ route('student.register') }}" target="_blanck">ابدأ الان</a>
                            </button> -->
                            <a href="{{ route('student.register') }}" class="btn btn-primary  startnow"    target="_blanck">ابدأ الان</a>

                        </div>
                    </div>
                </div>
            </nav>

        </div>
    </div>
    <!--end navbar -->


    <!--start page-register -->
    <div class="page-register">
        <div class="container">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12">
                    <div class="card text-white mb-3 registersections">
                        <form action="{{ route('student.register') }}" method="post">
                            
                            @csrf
                            <div class="card-header header-login">
                                <h1 class="header-logined">انشاء حساب جديد</h1>

                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <p><strong>Opps Something went wrong</strong></p>
                                        <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            {{dd('dd')}}
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(session('success'))
                                    <div class="alert alert-success">{{session('success')}}</div>
                                @endif

                                @if(session('error'))
                                    <div class="alert alert-danger">{{session('error')}}</div>
                                @endif
                                
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <p><strong>Opps Something went wrong</strong></p>
                                            <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    
                                    @if(session('success'))
                                        <div class="alert alert-success">{{session('success')}}</div>
                                    @endif
                                    
                                    @if(session('error'))
                                        <div class="alert alert-danger">{{session('error')}}</div>
                                    @endif

                                        <div class="col-xxl-6 mb-3 form-groups ">
                                            <label class="form-label form-labeld">
                                                الاسم الاول
                                            </label>
                                            <input type="text" name="first_name" required class="form-control form-controled"
                                             placeholder=" الاسم الاول">
                                        </div>

                                        <div class="col-xxl-6 mb-3 form-groups ">
                                            <label class="form-label form-labeld">
                                                الاسم الثاني
                                            </label>
                                            <input type="text" name="last_name" required class="form-control form-controled"
                                             placeholder=" الاسم الثاني">
                                        </div>
    
                                        <div class="col-xxl-6 mb-3 form-groups ">
                                            <label class="form-label form-labeld">رقم تليفون
                                                الطالب</label>
                                            <input type="tel" name="phone" required class="form-control form-controled"
                                             placeholder="رقم تليفون الطالب">
                                        </div>
    
                                        <div class="col-xxl-6 mb-3 form-groups ">
                                            <label class="form-label form-labeld">
                                                رقم تليفون ولي الامر
                                            </label>
                                            <input type="tel" name="parent_phone" class="form-control form-controled"
                                             placeholder="رقم تليفون ولي الامر">
                                        </div>

                                        <div class="col-xxl-6 mb-3 form-groups">
                                            <label class="form-label form-labeld">كلمة
                                                المرور</label>
                                            <input type="password" name="password" required class="form-control form-controled"
                                             placeholder="كلمة المرور">
                                            <i class="fas fa-eye-slash slashed"></i>
                                        </div>
    
                                        <div class="col-xxl-6 mb-3 form-groups">
                                            <label class="form-label form-labeld">
                                                تأكيد كلمة المرور
                                            </label>
                                            <input type="password" name="password_confirmation" required class="form-control form-controled"
                                             placeholder="تأكيد كلمة المرور" >
                                            <i class="fas fa-eye-slash slashed"></i>
                                        </div>

                                        <div class="col-xxl-6 mb-3 form-groups">
                                            <label class="form-label form-labeld">
                                                الصف الدراسي
                                            </label>
                                            <select class="form-select form-controled controledselected" name="study_stage_level_id" required aria-label="Default select example">
                                                
                                               
                                            </select>
                                            <i class="fas fa-chevron-down slasheds"></i>
                                        </div>
    
    
                                </div>
                                <div class="startnowsectionlogin mx-auto">
                                    <button type="button" class="btn btn-primary  startnowsectionlogin"
                                         autocomplete="off">
                                        <a href="{{ route('student.register') }}">انشاء حساب </a>
                                    </button>
                                </div>
    
                            </div>
                            
                        </form>
                    </div>

                </div>

                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12">
                    <div class="imageedlogo mx-auto text-center">
                        <img src="{{asset('web')}}/image/logo.png" alt="" class="logopagesrgisters">
                        <!-- <h1 style="color: aliceblue; font-size: 40px; font-weight: bold;">LMS</h1> -->
                        <div class="freenewreg">
                            <h1 class="freenewregister">سجل الان واحصل علي  حصتين  مجاناً
                            </h1>    
                        </div>
    
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!--end page-register -->






    <!-- start serction footers -->
    <footer class="footers footerslogin">
        <div class="container">
            <div class="row">
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6 col-12">
                    <div class="aboutlogo aboutlogoed">
                         <!--<h3>LMS</h3>-->
                        <img src="{{asset('web')}}/image/logo.png" alt="" class="foteesimages">
                        <p class="pfooterabouts">إمكانية العمل على المنصات التعليمية من خلال بيئات تشغيل مختلفة وأجهزة
                            مختلفة بتوافقية عالية مميزات أنظمة إدارة المحتوى الإلكتروني وبين شبكات التواصل الاجتماعي
                            الفيس بوك، وتمكن المعلمين من نشر الدروس
                        </p>
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6 col-12">
                    <div class="linkes">
                        <h5 class="linked">روابط مهمة</h5>
                        <ul class="linkedabout">
                            <li class="linkedhave">
                                <a href="#">عنا</a>
                            </li>
                            <li class="linkedhave">
                                <a href="#"> تواصل معنا
                                </a>
                            </li>
                            <li class="linkedhave">
                                <a href="#"> الاحكام والشروط
                                </a>
                            </li>
                            <li class="linkedhave">
                                <a href="#"> سياسة الخصوصية
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6 col-12">
                    <div class="contacme">
                        <h5 class="addressfoteers">تواصل معنا</h5>
                        <ul class="addressfotee">
                            <li class="addre">
                                <i class="fas fa-map-marker-alt addresfooter"></i>
                                العنوان
                            </li>
                            <li class="linkedhave">
                                <i class="fas fa-phone-alt phonefooter"></i>
                                 
                            </li>
                            <li class="linkedhave">
                                <i class="far fa-envelope emailsfooter"></i>
                                 
                            </li>
                            <div class="socialfooter">
                                <a href="https://www.facebook.com/TechPerformanceEgy/" class="sociallinkfooter"
                                    target="_blank">
                                    <i class="fab fa-instagram fa-1x fottfooter"></i>
                                </a>
                                <a href="https://www.facebook.com/TechPerformanceEgy/" class="sociallinkfooter"
                                    target="_blank">
                                    <i class="fab fa-facebook  fa-1x fottfooters"></i>
                                </a>
                                <a href="https://www.facebook.com/TechPerformanceEgy/" class="sociallinkfooter"
                                    target="_blank">
                                    <i class="fab fa-twitter  fa-1x fottfooters"></i>
                                </a>
                            </div>
                        </ul>
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6 col-12">
                    <div class="Subscribe">
                        <h1 class="titlesfooter">قم بالاشتراك</h1>
                        <p class="pfooter">ليصلك كل جديد عبر بريدك الاكتروني</p>
                        <form action="{{route('student.mailingList')}}" method="post" class="form-submit">
                            @csrf
                            @method('POST')
                            <input type="email" name="email" placeholder=" ">
                            <input type="submit" value="اشترك">
                        </form>

                    </div>
                </div>



            </div>
        </div>


    </footer>

    <!-- end serction footers -->




    <!-- start script -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script> -->
    <script src="{{asset('web')}}/js/jquery-3.6.0.min.js"></script>
    <script src="{{asset('web')}}/js/popper.min.js"></script>
    <script src="{{asset('web')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('web')}}/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('web')}}/js/owl.carousel.min.js"></script>

    <script src="{{asset('web')}}/js/mins.js"></script>
    <!-- start script -->


    <script type="text/javascript">
        
    </script>

</body>

</html>