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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <title>{{ $settings->name }} | التسجيل</title>
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
                    <a class="nav-link login" href="{{ route('student.login') }}">
                        <svg id="svg-members" viewBox="0 0 20 20" preserveAspectRatio="xMinYMin meet">
                            <path d="M10,10c2.762,0,5-2.238,5-5c0-2.762-2.238-5-5-5S5,2.238,5,5C5,7.761,7.238,10,10,10z M10,2c1.654,0,3,1.346,3,3s-1.346,3-3,3S7,6.654,7,5S8.346,2,10,2z M13,12H7c-3.313,0-6,2.686-6,6v2h2v-2c0-2.205,1.794-4,4-4h6c2.206,0,4,1.795,4,4v2h2v-2C19,14.686,16.313,12,13,12z"></path>
                        </svg>
                        دخول
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
                    <div class="form-box-title">انشاء حساب جديد</div>
                    <form action="{{ route('student.register') }}" method="post" class="form">
                        @include('web.layouts.inc.flash-message')
                        @csrf
                        <div class="form-group">
                            <label>الاسم بالكامل</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label>رقم تليفون الطالب</label>
                            <input type="text" name="phone" required pattern="(01)[0-9]{9}" value="{{ old('phone') }}" placeholder="EX: 01012345678" class="form-control" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)">
                        </div>

                        <div class="form-group">
                            <label>رقم ولى الأمر</label>
                            <input type="text" name="parent_phone" equired pattern="(01)[0-9]{9}" value="{{ old('parent_phone') }}" placeholder="EX: 01012345678" class="form-control" onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 48 && event.charCode <= 57)">
                        </div>

                        <div class="form-group cw-50">
                            <label>الباسورد</label>
                            <input type="password" name="password" required class="form-control">
                        </div>

                        <div class="form-group cw-50">
                            <label>اعد كتابة الباسورد</label>
                            <input type="password" name="password_confirmation" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label>الصف الدراسى</label>
                            <select name="study_stage_id" class="form-control"  required>
                                <option value="" selected>اختر المرحلة الدراسية</option>
                                @foreach ($StudyStages as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-check">
                            
                            <input type="radio" name="specialization" class="form-check-input" value="scientific">
                            <p class="form-check-label" >علمي</p>
                            &nbsp;&nbsp;
                            <input type="radio" name="specialization" class="form-check-input" value="literary">
                            <p class="form-check-label" >ادبي</p>
                            &nbsp;&nbsp;
                            <input type="radio" name="specialization" class="form-check-input" value="science">
                            <p class="form-check-label" >علمي علوم</p>
                            &nbsp;&nbsp;
                            <input type="radio" name="specialization" class="form-check-input" value="maths">
                            <p class="form-check-label" >علمي رياضة</p>
                            &nbsp;&nbsp;
                            <input type="radio" name="specialization" class="form-check-input" value="common">
                            <p class="form-check-label" >لم يحدد بعد</p>
                        </div>

                        <div class="form-group form-check">
                            <input type="radio" name="gender" class="form-check-input" value="male">
                            <p class="form-check-label" >ذكر</p>
                            &nbsp;&nbsp;
                            <input type="radio" name="gender" class="form-check-input" value="female">
                            <p class="form-check-label" >انثى</p>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" required class="form-check-input">
                            <p class="form-check-label" >اوافق على <a>الشروط والأحكام</a></p>
                        </div>

                        <button type="submit" class="create-account-btn">
                                <svg class="svg-icon" viewBox="0 0 20 20">
                                <path fill="none" d="M18.737,9.691h-5.462c-0.279,0-0.527,0.174-0.619,0.437l-1.444,4.104L8.984,3.195c-0.059-0.29-0.307-0.506-0.603-0.523C8.09,2.657,7.814,2.838,7.721,3.12L5.568,9.668H1.244c-0.36,0-0.655,0.291-0.655,0.655c0,0.36,0.294,0.655,0.655,0.655h4.8c0.281,0,0.532-0.182,0.621-0.45l1.526-4.645l2.207,10.938c0.059,0.289,0.304,0.502,0.595,0.524c0.016,0,0.031,0,0.046,0c0.276,0,0.524-0.174,0.619-0.437L13.738,11h4.999c0.363,0,0.655-0.294,0.655-0.655C19.392,9.982,19.1,9.691,18.737,9.691z"></path>
                            </svg>
                            انشاء حساب
                        </button>

                        <div class="form-group" style="text-align:center;">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                            <span class="text-danger" id="captcha-error">{{ $errors->first('g-recaptcha-response') }}</span>
                        </div>

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

<script>
    
    $('#contactus').on('submit', function(){
    var v = grecaptcha.getResponse();
        if(v.length == 0)
        {
            document.getElementById('captcha-error').innerHTML="لا يمكنك ترك كود Captcha فارغًا";
            return false;
        }
        else
        {
            document.getElementById('captcha-error').innerHTML="اكتمل اختبار Captcha";
            return true; 
        }
    });
</script>
</body>
</html>