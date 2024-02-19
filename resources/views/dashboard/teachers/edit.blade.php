@extends('dashboard.layouts.app')

@section('meta_title')
    تعديل المدرس
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">تعديل المدرس</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form method="POST" action="{{ route('dashboard.teachers.update', $Teacher->id) }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">الاسم</label>
                            <div class="col-lg-6">
                                <input type="text" name="name" value="{{ $Teacher->name }}" class="form-control m-input m-input--solid" >
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">وصف بايو</label>
                            <div class="col-lg-6">
                                <input type="text" name="bio" value="{{ $Teacher->bio }}" class="form-control m-input m-input--solid">
                            </div>
                        </div>

                        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رابط حساب الانستا</label>
                            <div class="col-lg-6">
                                <input type="text" name="insta_url" value="{{ $Teacher->insta_url }}" class="form-control m-input m-input--solid">
                            </div>
                        </div>

                        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رابط حساب الفيسبوك</label>
                            <div class="col-lg-6">
                                <input type="text" name="fb_url" value="{{ $Teacher->fb_url }}" class="form-control m-input m-input--solid">
                            </div>
                        </div>

                        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رابط قناة اليوتيوب</label>
                            <div class="col-lg-6">
                                <input type="text" name="yt_url" value="{{ $Teacher->yt_url }}" class="form-control m-input m-input--solid">
                            </div>
                        </div>

                        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رابط حساب التيك توك</label>
                            <div class="col-lg-6">
                                <input type="text" name="tk_url" value="{{ $Teacher->tk_url }}" class="form-control m-input m-input--solid">
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رقم الواتساب ١</label>
                            <div class="col-lg-6">
                                <input type="text" name="whatsapp_phone_1" value="{{ $Teacher->whatsapp_1 }}"  class="form-control m-input m-input--solid">
                            </div>
                        </div>

                        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رقم الواتساب ٢</label>
                            <div class="col-lg-6">
                                <input type="text" name="whatsapp_phone_2" value="{{ $Teacher->whatsapp_2 }}"  class="form-control m-input m-input--solid">
                            </div>
                        </div>

                        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رقم الواتساب ٣</label>
                            <div class="col-lg-6">
                                <input type="text" name="whatsapp_phone_3" value="{{ $Teacher->whatsapp_3 }}"  class="form-control m-input m-input--solid">
                            </div>
                        </div>
        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">البريد الالكتروني</label>
                            <div class="col-lg-6">
                                <input type="text" name="email" value="{{$Teacher->email }}" class="form-control m-input m-input--solid" >
                            </div>
                        </div>
        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">رقم الهاتف</label>
                            <div class="col-lg-6">
                                <input type="text" name="phone" value="{{ $Teacher->phone }}" class="form-control m-input m-input--solid" >
                            </div>
                        </div>
        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">صورة</label>
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
                                <input type="password" name="password" placeholder="ادخل كلمة سر جديدة" class="form-control m-input m-input--solid" >
                            </div>
                        </div>
        
        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">تأكيد كلمة السر</label>
                            <div class="col-lg-6">
                                <input type="password" name="password_confirmation" placeholder="اعد ادخال كلمة السر" class="form-control m-input m-input--solid" >
                            </div>
                        </div>
        
                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">المواد الدراسية</label>
                            <div class="col-lg-6">
                                <select name="subject_ids[]" required multiple class="form-control select2" style="width: 100%;">
                                    {{-- <option value="">اختر المواد</option> --}}
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}" @if (in_array($subject->id, $Teacher->subjects->pluck(['id'])->toArray())) selected @endif>{{ $subject->grade->name }} - {{ $subject->name }}</option>
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
                            <button type="submit" class="btn btn-info">حفظ</button>
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
