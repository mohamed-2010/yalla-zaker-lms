@extends('dashboard.layouts.app')
@push('page_styles')

@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            اضافة دورة جديدة
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                                <a href="{{ route('dashboard.roles.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="fa fa-stream"></i>
                                    <span>جميع الدورات</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>
                    </ul>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.roles.store') }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                @csrf

                
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الاسم</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control m-input m-input--solid" >
                        </div>
                    </div>
                </div>

                <div class="m-form__group form-group row">
                    <label class="col-2 col-form-label">الصلاحيات</label>
                    <div class="col-8">
                        <div class="m-checkbox-inline">
                            @foreach($permissions as $permission)

                                <label class="m-checkbox">
                                    <input type="checkbox" name="permissions[]" @if (old('permissions') !== null && in_array($permission->id, old('permissions'))) checked="checked" @endif value="{{ $permission->id }}"> {{ $permission->display_name }}
                                    <span></span>
                                </label>
                            @endforeach
                           
                            
                        </div>
                        {{-- <span class="m-form__help">Some help text goes here</span> --}}
                    </div>
                </div>

                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-accent">اضافة</button>
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

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
