@extends('dashboard.layouts.app')

@section('meta_title')
    إضافه
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">إضافه</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form method="POST" action="{{ route('dashboard.teachers.store') }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                        @csrf
        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">الاسم</label>
                            <div class="col-lg-6">
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control m-input m-input--solid" >
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">وصف بايو</label>
                            <div class="col-lg-6">
                                <input type="text" name="bio" class="form-control m-input m-input--solid">
                            </div>
                        </div>

                        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رابط حساب الانستا</label>
                            <div class="col-lg-6">
                                <input type="text" name="insta_url" value="{{ old('insta_url') }}" class="form-control m-input m-input--solid">
                            </div>
                        </div>

                        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رابط حساب الفيسبوك</label>
                            <div class="col-lg-6">
                                <input type="text" name="fb_url" value="{{ old('fb_url') }}" class="form-control m-input m-input--solid">
                            </div>
                        </div>

                        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رابط قناة اليوتيوب</label>
                            <div class="col-lg-6">
                                <input type="text" name="yt_url" value="{{ old('yt_url') }}" class="form-control m-input m-input--solid">
                            </div>
                        </div>

                        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رابط حساب التيك توك</label>
                            <div class="col-lg-6">
                                <input type="text" name="tk_url" value="{{ old('tk_url') }}" class="form-control m-input m-input--solid">
                            </div>
                        </div>

                        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رقم الواتساب ١</label>
                            <div class="col-lg-6">
                                <input type="text" name="whatsapp_phone_1" value="{{ old('whatsapp_phone') }}"  class="form-control m-input m-input--solid">
                            </div>
                        </div>

                        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رقم الواتساب ٢</label>
                            <div class="col-lg-6">
                                <input type="text" name="whatsapp_phone_2" value="{{ old('whatsapp_phone') }}"  class="form-control m-input m-input--solid">
                            </div>
                        </div>

                        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رقم الواتساب ٣</label>
                            <div class="col-lg-6">
                                <input type="text" name="whatsapp_phone_3" value="{{ old('whatsapp_phone') }}"  class="form-control m-input m-input--solid">
                            </div>
                        </div>
        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">البريد الالكتروني</label>
                            <div class="col-lg-6">
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control m-input m-input--solid" >
                            </div>
                        </div>
        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رقم الهاتف</label>
                            <div class="col-lg-6">
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control m-input m-input--solid" >
                            </div>
                        </div>
        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">صورة مقاس ٣٠٠ * ٣٠٠</label>
                            <div class="col-lg-6">
                                <input type="file" name="image" class="form-control m-input m-input--solid">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">صورة الغطاء مقاس ٢٦١٠ * ٧٠٠</label>
                            <div class="col-lg-6">
                                <input type="file" name="cover" class="form-control m-input m-input--solid">
                            </div>
                        </div>
        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">كلمة السر</label>
                            <div class="col-lg-6">
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control m-input m-input--solid" >
                            </div>
                        </div>
        
        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">تأكيد كلمة السر</label>
                            <div class="col-lg-6">
                                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control m-input m-input--solid" >
                            </div>
                        </div>
        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">المواد الدراسية</label>
                            <div class="col-lg-6">
                                <select name="subject_ids[]" required multiple class="form-control select2" style="width: 100%;">
                                    {{-- <option value="">اختر المواد</option> --}}
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}" @if (old('subject_ids') != null && in_array($subject->id, old('subject_ids'))) selected @endif>{{ $subject->grade->name }} - {{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
        
        
                        {{-- <div class="m-form__group m-form__group--last form-group row">
                            <label class="col-lg-2 col-form-label">التخصص</label>
                            <div class="col-lg-6">
                                <div class="m-checkbox-inline">
                                    <label class="m-checkbox">
                                        <input type="radio" name="specialization" checked  value="scientific"> علمي
                                        <span></span>
                                    </label>
                                    <label class="m-checkbox">
                                        <input type="radio" name="specialization" @if (old('specialization') == 'science')  {{ 'checked' }} @endif value="science"> علمي علوم
                                        <span></span>
                                    </label>
                                    
                                    <label class="m-checkbox">
                                        <input type="radio" name="specialization"  @if (old('specialization') == 'maths')  {{ 'checked' }} @endif value="maths"> علمي رياضة
                                        <span></span>
                                    </label>
        
                                    <label class="m-checkbox">
                                        <input type="radio" name="specialization"  @if (old('specialization') == 'literary')  {{ 'checked' }} @endif value="literary"> ادبي
                                        <span></span>
                                    </label>
        
                                    <label class="m-checkbox">
                                        <input type="radio" name="specialization"  @if (old('specialization') == 'common')  {{ 'checked' }} @endif value="common"> مشترك
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div> --}}
        
                        <div class="text-xs-left">
                            <button type="submit" class="btn btn-info">إضافه</button>
                        </div>
        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>

</script>
@endpush
