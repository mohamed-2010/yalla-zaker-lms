@extends('dashboard.layouts.app')
@push('page_styles')

@endpush
@section('content')

<div class="col-12">
    <div class="box">
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--tab">

            <div class="m-portlet__head-caption">
                <div class="d-flex align-items-center logo-box justify-content-between box-header with-border">
                    <h4 class="box-title">الطلاب - تعديل بيانات الطالب</h4>
                    @can('student-create')
                        <a href="{{ route('dashboard.students.index') }}" class="waves-effect waves-light btn btn-primary mb-5">جميع الطلاب</a>
                    @endcan
                </div>
            </div>

            <div class="box-body">
                <!--begin::Form-->
                <form method="POST" action="{{ route('dashboard.students.update', ['id' => $student->id]) }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')


                    {{-- <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الصف الدراسي</label>
                        <div class="col-lg-6">
                            <input disabled type="text" value="{{ $student->grade->name }}" required class="form-control m-input m-input--solid" >
                        </div>
                    </div> --}}


                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الاسم</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" value="{{ $student->name }}" required class="form-control m-input m-input--solid" >
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


                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">

                    </div>

                </form>
                <!--end::Form-->
            </div>
        </div>

        <!--end::Portlet-->
    </div>
</div>

@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush

