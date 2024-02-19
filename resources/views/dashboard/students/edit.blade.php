@extends('dashboard.layouts.app')
@push('page_styles')

@endpush
@section('content')

<div class="col-12">
    <div class="box">
        <div class="m-portlet__head-caption">
            <div class="d-flex align-items-center logo-box justify-content-between box-header with-border">
                <h4 class="box-title">الطلاب - تعديل بيانات الطالب</h4>
                @can('student-create')
                    <a href="{{ route('dashboard.students.index') }}" class="waves-effect waves-light btn btn-primary mb-5">جميع الطلاب</a>
                @endcan
            </div>
        </div>
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--tab">
            <div class="box-body">
                <!--begin::Form-->
                <form method="POST" action="{{ route('dashboard.students.update', $student->id) }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الاسم</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" value="{{ $student->name }}" required class="form-control m-input m-input--solid" >
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">البريد الالكتروني</label>
                        <div class="col-lg-6">
                            <input type="text" name="email" value="{{ $student->email }}" required class="form-control m-input m-input--solid" >
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">رقم الهاتف</label>
                        <div class="col-lg-6">
                            <input type="text" name="phone" value="{{ $student->phone }}" required class="form-control m-input m-input--solid" >
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">رقم هاتف ولي الامر</label>
                        <div class="col-lg-6">
                            <input type="text" name="parent_phone" value="{{ $student->parent_phone }}" required class="form-control m-input m-input--solid" >
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">نوع الحضور</label>
                        <div class="col-lg-6">
                            <select class="form-control select2" style="width: 100%;" id="attend_type" name="attend_type" required>
                                <option value="center" @if(old('attend_type') == "center") selected @endif>سنتر</option>
                                <option value="online" @if(old('attend_type') == "online") selected @endif>اونلاين</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">تحديد المحافظه</label>
                        <div class="col-lg-6">
                            <select class="form-control select2" style="width: 100%;" id="government" name="government" required>
                                <option value="">اختار المحافظه</option>
                                @foreach($governments as $government)
                                    <option value="{{$government->id}}"> {{$government->name}} </option> 
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">تحديد المنطقه</label>
                        <div class="col-lg-6">
                            <select class="form-control select2" style="width: 100%;" id="area" name="area" required>
                                
                            </select>
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

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary">تعديل</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <!--end::Form-->
            </div>
        </div>

        <!--end::Portlet-->
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
    });
</script>

@endpush
