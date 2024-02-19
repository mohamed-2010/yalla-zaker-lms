@extends('dashboard.layouts.app')

@section('meta_title')
    تعديل القسم
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">تعديل القسم</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Method spoofing to make it a PUT request --}}

                        <div class="row">
                            <div class="col-12">

                                <div class="language-form" id="form">
                                        <div class="form-group">
                                            <label>الاسم <span class="text-danger">*</span></label>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control"
                                                        value="{{ $category->name }}"
                                                        required data-validation-required-message="This field is required">
                                            </div>
                                        </div>
                                </div>

                                <div class="form-group">
									<label>الصف <span class="text-danger">*</span></label>
									<div class="controls">
										<select class="form-control select2" style="width: 100%;" name="grade_id" id="grade">
                                                <option>اختر الصف</option>
                                                @foreach($grades as $grade) 
                                                        <option value="{{ $grade->id }}" @if($grade->id == $category->grade_id) selected="selected" @endif>{{ $grade->name }}</option>
                                                @endforeach
                                        </select>
									</div>
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
@push('scripts')

@endpush
