@extends('dashboard.layouts.app')
@push('page_styles')

@endpush
@section('content')

<div class="col-12">
    <div class="box">
        <!--begin::Portlet-->
            <div class="m-portlet__head-caption">
                <div class="d-flex align-items-center logo-box justify-content-between box-header with-border">
                    <h4 class="box-title">الطلاب - اضافة طالب</h4>
                    @can('student-create')
                        <a href="{{ route('dashboard.students.index') }}" class="waves-effect waves-light btn btn-primary mb-5">جميع الطلاب</a>
                    @endcan
                </div>
            </div>


            <div class="box-body">
                
                <!--begin::Form-->
                <form method="POST" action="{{ route('dashboard.students.store') }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الاسم</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control m-input m-input--solid" >
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

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary">اضافة</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <!--end::Form-->

            </div>
        <!--end::Portlet-->
    </div>
</div>

@endsection

