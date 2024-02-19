@extends('dashboard.layouts.app')

@section('meta_title')
    
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">إضافه</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('dashboard.categories.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">

                                <div class="language-form" id="form">
                                        <div class="form-group">
                                            <label>الاسم <span class="text-danger">*</span></label>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control"
                                                    data-validation-required-message="This field is required">
                                            </div>
                                        </div>
                                </div>

                                <div class="form-group">
									<label>الصف <span class="text-danger">*</span></label>
									<div class="controls">
										<select class="form-control select2" style="width: 100%;" name="grade_id" id="grade">
                                            <option>اختر الصف</option>
                                            @foreach($grades as $grade)
                                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
									</div>
								</div>

                            </div>
                            <div class="text-xs-left">
                                <button type="submit" class="btn btn-info">إضافه</button>
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
