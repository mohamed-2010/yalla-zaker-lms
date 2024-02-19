@extends('dashboard.layouts.app')

@section('meta_title')
    تعديل المادة
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">تعديل الماده</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ route('dashboard.subjects.update', $subject->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Method spoofing to make it a PUT request --}}

                        <div class="row">
                            <div class="col-12">

                                {{-- Language Contents --}}
                                <div class="language-form" id="form">
                                        <div class="form-group">
                                            <label>الاسم <span class="text-danger">*</span></label>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control"
                                                        value="{{ $subject->name }}"
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
                                                        <option value="{{ $grade->id }}" @if($grade->id == $subject->grade_id) selected="selected" @endif>{{ $grade->name }}</option>
                                                @endforeach
                                        </select>
									</div>
								</div>

                                <div class="form-group">
									<label>القسم <span class="text-danger">*</span></label>
									<div class="controls">
										<select  multiple class="form-control select2" style="width: 100%;" name="category_ids[]" id="category">                                            
                                            @foreach($categories as $category) 
                                                    @if($category->grade_id == $subject->grade->id) 
                                                        <option value="{{ $category->id }}" @if ( in_array($category->id, $subject->categories->pluck(['id'])->toArray()) ) selected="selected" @endif>{{ $category->name }}</option>
                                                    @endif
                                            @endforeach
                                        </select>
									</div>
								</div>

                                <div class="form-group">
									<label>صورة الغلاف <span class="text-danger">*</span></label>
									<div class="controls">
										<input type="file" name="image" class="form-control"> 
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
<script>
    $(document).ready(function() {
        const categorySelect = $('#category');
        const gradeSelect = $('#grade');
        const allCategories = @json($categories);

        gradeSelect.change(function() {
            const selectedGradeId = $(this).val();
            updateCategoryOptions(selectedGradeId);
        });

        function updateCategoryOptions(gradeId) {
            categorySelect.empty(); // Clear existing options

            // Add a default option
            categorySelect.append($('<option>', {
                value: '',
                text: 'اختار القسم'
            }));

            // Filter and append options based on the selected stage
            $.each(allCategories, function(i, category) {
                if (category.grade_id == gradeId) {
                    categorySelect.append($('<option>', {
                        value: category.id,
                        text: category.name
                    }));
                }
            });

            // If you are using Select2, refresh it after updating the options
            categorySelect.trigger('change');
        }
    });
    
</script>
@endpush
