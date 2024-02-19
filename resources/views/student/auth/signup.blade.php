@extends('student.layouts.app')

@section('meta_title')
    
@endsection

@section('content')

<div class="rbt-course-area bg-color-extra2 rbt-section-gap">
    <div class="container">
        <div class="row gy-5 row--30 d-flex flex-column justify-center align-items-center">

            <div class="col-lg-6">
                <div class="rbt-contact-form contact-form-style-1 max-width-auto">
                    <h3 class="title">انشاء حساب</h3>
                    <form class="max-width-auto" id="signup-form" action="{{ route('signup.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input name="email" type="text" required value="{{ old('email') }}"/>
                            <label>البريد الالكتروني *</label>
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group">
                            <input name="name" type="text" value="{{ old('name') }}" required pattern="^[a-zA-Z]+\s[a-zA-Z]+\s[a-zA-Z]+$" title="الاسم ثلاثي يجب أن يتكون من ثلاثة كلمات فقط" />
                            <label>الاسم ثلاثي *</label>
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group">
                            <input name="phone" type="text" value="{{ old('phone') }}" required pattern="^\d{11}$" title="رقم الهاتف يجب أن يتكون من 11 رقم فقط" />
                            <label>رقم الهاتف *</label>
                            <span class="focus-border"></span>
                        </div>

                        <div class="form-group">
                            <input name="parent_phone" type="text" value="{{ old('parent_phone') }}" required pattern="^\d{11}$" title="رقم ولي الأمر يجب أن يتكون من 11 رقم فقط" />
                            <label>رقم ولي الامر *</label>
                            <span class="focus-border"></span>
                        </div>

                        <div class="col-lg-12">
                            <label>نوع الحضور</label>
                            <div class="rbt-modern-select bg-transparent height-45 mb-2">
                                <select class="w-100" id="attend_type" name="attend_type" required>
                                    <option value="center" @if(old('attend_type') == "center") selected @endif>سنتر</option>
                                    <option value="online" @if(old('attend_type') == "online") selected @endif>اونلاين</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <label>تحديد المحافظه</label>
                            <div class="rbt-modern-select bg-transparent height-45 mb-2">
                                <select class="w-100" id="government" name="government" required>
                                    <option value="">اختار المحافظه</option>
                                    @foreach($governments as $government)
                                        <option value="{{$government->id}}"> {{$government->name}} </option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <label>تحديد المنطقه</label>
                            <div class="rbt-modern-select bg-transparent height-45 mb-2">
                                <select class="w-100" id="area" name="area" required>
                                    
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <input name="password" type="password" required />
                            <label>كلمة السر *</label>
                            <span class="focus-border"></span>
                        </div>

                        

                        <div class="form-submit-group">
                            <button type="submit" class="rbt-btn btn-md btn-gradient hover-icon-reverse w-100">
                                <span class="icon-reverse-wrapper">
                                    <span class="btn-text">تسجيل</span>
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
    $(document).ready(function() {
        const areaSelect = $('#area');
        const governmentSelect = $('#government');
        const allGovernments = @json($governments);

        governmentSelect.change(function() {
            const selectedGovernmentId = $(this).val();
            updateAreaOptions(selectedGovernmentId);
        });

        function updateAreaOptions(governmentId) {
            areaSelect.empty(); // Clear existing options
            areaSelect.append($('<option>', { value: '', text: 'اختار المدينه' })); // Optional: add a default "Select Area" option

            // Find the selected government by ID
            const selectedGovernment = allGovernments.find(gov => gov.id.toString() === governmentId);
            if (selectedGovernment && selectedGovernment.areas) {
                $.each(selectedGovernment.areas, function(index, area) {
                    areaSelect.append($('<option>', {
                        value: area.id,
                        text: area.name
                    }));
                });
            }
            
            // Refresh areaSelect if using plugins like Select2
            // areaSelect.select2(); // Uncomment if you are using Select2 for styling
            areaSelect.selectpicker('refresh'); // Trigger change to update UI
        }

        $('#signup-form').submit(function(e) {
            e.preventDefault();
            
            // Perform form validation here
            const email = $('input[name="email"]').val();
            const name = $('input[name="name"]').val();
            const phone = $('input[name="phone"]').val();
            const parentPhone = $('input[name="parent_phone"]').val();
            
            // Check if all fields are filled
            if (!email || !name || !phone || !parentPhone) {
                $(document).ready(function(){ $.notify("يرجى ملء جميع الحقول", {autoHideDelay: 30000, globalPosition: 'bottom left', className: 'error',clickToHide: true}); });
                return;
            }
            
            // Check if name has three words
            const nameWords = name.split(' ');
            if (nameWords.length !== 3) {
                $(document).ready(function(){ $.notify("الاسم ثلاثي يجب أن يتكون من ثلاثة كلمات فقط", {autoHideDelay: 30000, globalPosition: 'bottom left', className: 'error',clickToHide: true}); });
                return;
            }
            
            // Check if phone number has 11 digits
            if (phone.length !== 11) {
                $(document).ready(function(){ $.notify("رقم الهاتف يجب أن يتكون من 11 رقم فقط", {autoHideDelay: 30000, globalPosition: 'bottom left', className: 'error',clickToHide: true}); });
                return;
            }
            
            // Check if parent phone number has 11 digits
            if (parentPhone.length !== 11) {
                $(document).ready(function(){ $.notify("رقم ولي الأمر يجب أن يتكون من 11 رقم فقط", {autoHideDelay: 30000, globalPosition: 'bottom left', className: 'error',clickToHide: true}); });
                return;
            }
            
            // Check if phone and parent phone numbers are different
            if (phone === parentPhone) {
                $(document).ready(function(){ $.notify("رقم الهاتف ورقم ولي الأمر يجب أن يكونا مختلفين", {autoHideDelay: 30000, globalPosition: 'bottom left', className: 'error',clickToHide: true}); });
                return;
            }
            
            // Submit the form if all validations pass
            this.submit();
        });
    });
</script>

@endpush