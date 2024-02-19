<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('web')}}/scss/libs/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('web')}}/scss/enter.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>{{ $settings->name }} | تسجيل الدخول</title>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '3220802041381213'); 
        fbq('track', 'PageView');
        </script>
        <noscript>
        <img height="1" width="1" 
        src="https://www.facebook.com/tr?id=3220802041381213&ev=PageView
        &noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-S1GMKP0CR7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-S1GMKP0CR7');
    </script>
</head>
<body>
    
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{asset('web')}}/images/inhome.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link signup" href="{{ route('student.register') }}">
                            <svg id="svg-login" viewBox="0 0 20 20" preserveAspectRatio="xMinYMin meet">
                                <path d="M13,2.523v2.176c2.358,1.126,4,3.513,4,6.301c0,3.866-3.134,7-7,7s-7-3.134-7-7c0-2.788,1.642-5.175,4-6.301V2.523C3.507,3.76,1,7.083,1,11c0,4.971,4.029,9,9,9s9-4.029,9-9
                                C19,7.083,16.493,3.76,13,2.523z M11,0H9v10h2V0z"></path>
                            </svg>
                            حساب جديد
                        </a>
                      
                        <a class="nav-link active" href="{{ route('index') }}">الرئيسية<span class="sr-only">(current)</span></a>
      
                    </div>
                </div>
            </div>
        </nav>
        <div class="signup">
            <div class="overlay"></div>
            <div class="enter">
    
                <div class="form-container">
                    <div class="form-card">
                        <div class="form-box-title">تسجيل الدخول</div>
                        
                            @include('web.layouts.inc.flash-message')

                        <form action="{{route('student.login')}}" method="post" class="form">
    
                            @csrf
                            <div class="form-group">
                                <label>رقم تليفون الطالب</label>
                                <input type="text" name="phone" name="phone" required pattern="(01)[0-9]{9}" value="{{ old('phone') }}" class="form-control" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)">
                            </div>
    
                            <div class="form-group cw-50">
                                <label>الباسورد</label>
                                <input type="password" name="password" required class="form-control">
                            </div>
    
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input">
                                <p class="form-check-label" for="exampleCheck1">تذكر حسابى المرة القادمة</p>
                            </div>
    
                            <button type="submit" class="create-account-btn">
                                <svg class="svg-icon" viewBox="0 0 20 20">
                                <path fill="none" d="M18.737,9.691h-5.462c-0.279,0-0.527,0.174-0.619,0.437l-1.444,4.104L8.984,3.195c-0.059-0.29-0.307-0.506-0.603-0.523C8.09,2.657,7.814,2.838,7.721,3.12L5.568,9.668H1.244c-0.36,0-0.655,0.291-0.655,0.655c0,0.36,0.294,0.655,0.655,0.655h4.8c0.281,0,0.532-0.182,0.621-0.45l1.526-4.645l2.207,10.938c0.059,0.289,0.304,0.502,0.595,0.524c0.016,0,0.031,0,0.046,0c0.276,0,0.524-0.174,0.619-0.437L13.738,11h4.999c0.363,0,0.655-0.294,0.655-0.655C19.392,9.982,19.1,9.691,18.737,9.691z"></path>
                            </svg>
                             تسجيل الدخول</button>
    
                        </form>
                    </div>
                </div>
    
        
            </div>
        </div>
    </div>

<!-- Libs Scripts -->
<script src="{{asset('web')}}/js/libs/jquery-3.2.1.min.js"></script>
<script src="{{asset('web')}}/js//libs/popper.js"></script>
<script src="{{asset('web')}}/js/libs/bootstrap.min.js"></script>
<!-- Main Script -->
<script src="{{asset('web')}}/js/enter.js"></script>
<!-- hexagon -->
</body>
</html>