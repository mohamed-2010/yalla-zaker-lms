@extends('student.layouts.app')

@section('meta_title')
    
@endsection

@section('content')

<div class="rbt-course-area bg-color-extra2 rbt-section-gap">
    <div class="container">
        <div class="row gy-5 row--30 d-flex flex-column justify-center align-items-center">

            <div class="col-lg-6">
                <div class="rbt-contact-form contact-form-style-1 max-width-auto">
                    <h3 class="title">تسجيل دخول</h3>
                    <form class="max-width-auto" action="{{ route('signin.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input name="email" type="email" />
                            <label>البريد الالكتروني *</label>
                            <span class="focus-border"></span>
                        </div>
                        <div class="form-group">
                            <input name="password" type="password">
                            <label>كلمة السر *</label>
                            <span class="focus-border"></span>
                        </div>

                        <div class="row mb--30">
                            <div class="col-lg-6">
                                <div class="rbt-checkbox">
                                    <input type="checkbox" id="rememberme" name="rememberme">
                                    <label for="rememberme">تذكرني</label>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div class="rbt-lost-password text-end">
                                    <a class="rbt-btn-link" href="#">Lost your password?</a>
                                </div>
                            </div> --}}
                        </div>

                        <div class="form-submit-group">
                            <button type="submit" class="rbt-btn btn-md btn-gradient hover-icon-reverse w-100">
                                <span class="icon-reverse-wrapper">
                                    <span class="btn-text">دخول</span>
                                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>

</script>

@endpush