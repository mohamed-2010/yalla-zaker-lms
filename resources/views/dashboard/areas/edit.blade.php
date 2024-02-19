@extends('dashboard.layouts.app')

@section('meta_title')
    تعديل المنطقه
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">تعديل المنطقه</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('dashboard.areas.update', $area->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Method spoofing to make it a PUT request --}}

                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
									<label>المحافظه <span class="text-danger">*</span></label>
									<div class="controls">
										<select class="form-control select2" style="width: 100%;" name="government_id" id="government">
                                            <option></option>
                                            @foreach($governments as $government)
                                                <option value="{{ $government->id }}" @if($government->id == $area->government_id) selected @endif>{{ $government->name }}</option>
                                            @endforeach
                                        </select>
									</div>
								</div>

                                <div class="form-group">
                                    <label>الاسم <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control"
                                            data-validation-required-message="This field is required" value="{{ $area->name }}">
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
