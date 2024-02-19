@extends('dashboard.layouts.app')

@section('meta_title')
    
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">تعديل المحافظه</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('dashboard.governments.update', $government->id) }}" method="POST">
                        @csrf
                        @method('PUT') 

                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <label>الاسم <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control"
                                                value="{{ $government->name }}"
                                                required data-validation-required-message="This field is required">
                                    </div>
                                </div>

                            </div>
                            <div class="text-xs-left">
                                <button type="submit" class="btn btn-info">تعديل</button>
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
