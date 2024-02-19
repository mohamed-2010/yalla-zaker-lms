@extends('dashboard.layouts.app')

@section('meta_title')
    تعديل الصف
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">تعديل الصف</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('dashboard.grades.update', $grade->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Method spoofing to make it a PUT request --}}

                        <div class="row">
                            <div class="col-12">

                                <div class="language-form" id="form">
                                        <div class="form-group">
                                            <label>الاسم <span class="text-danger">*</span></label>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control"
                                                        value="{{ $grade->name }}"
                                                        required data-validation-required-message="This field is required">
                                            </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>صورة الغلاف <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    @if($grade->getFirstMediaUrl('grades'))
                                        <div class="mt-2">
                                            <img src="{{ $grade->getFirstMedia('grades')->getUrl() }}" alt="Grade Cover" style="max-width: 200px; max-height: 200px;">
                                        </div>
                                    @endif
                                </div>

                            </div>
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
