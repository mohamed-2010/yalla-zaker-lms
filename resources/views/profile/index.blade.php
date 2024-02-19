@extends('dashboard.layouts.app')

@section('meta_title')
    تعديل الحساب
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">تعديل الحساب</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ auth()->user()->hasRole('admin') ? route('dashboard.profile.update') : route('dashboard.teacher.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            @if(auth()->user()->hasRole('admin'))
                                <div class="col-12">

                                    <div class="form-group">
                                        <label>الاسم <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control"
                                                    value="{{ $user->name }}"
                                                    required data-validation-required-message="This field is required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>البريد الالكتروني <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="email" class="form-control"
                                                    value="{{ $user->email }}"
                                                    required data-validation-required-message="This field is required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>كلمة السر <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="password" class="form-control"
                                                    required data-validation-required-message="This field is required">
                                        </div>
                                    </div>

                                </div>
                            @else
                                <div class="col-12">

                                    <div class="form-group">
                                        <label>الاسم <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control"
                                                    value="{{ $user->name }}"
                                                    required data-validation-required-message="This field is required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>البريد الالكتروني <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="email" class="form-control"
                                                    value="{{ $user->email }}"
                                                    required data-validation-required-message="This field is required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>البايو<span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="bio" class="form-control"
                                                    value="{{ $user->bio }}"
                                                    required data-validation-required-message="This field is required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>رابط الانستا<span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="insta_url" class="form-control"
                                                    value="{{ $user->insta_url }}"
                                                    required data-validation-required-message="This field is required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>رابط الفيسبوك<span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="fb_url" class="form-control"
                                                    value="{{ $user->fb_url }}"
                                                    required data-validation-required-message="This field is required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>رابط قناة اليوتيوب<span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="yt_url" class="form-control"
                                                    value="{{ $user->yt_url }}"
                                                    required data-validation-required-message="This field is required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>اليتك توك<span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="tk_url" class="form-control"
                                                    value="{{ $user->tk_url }}"
                                                    required data-validation-required-message="This field is required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>رقم الواتساب<span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="whatsapp" class="form-control"
                                                    value="{{ $user->whatsapp }}"
                                                    required data-validation-required-message="This field is required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>كلمة السر <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" name="password" class="form-control">
                                        </div>
                                    </div>
                                    
                                </div>
                            @endif

                            <div class="text-xs-left">
                                <button type="submit" class="btn btn-info">حفظ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
