@extends('dashboard.layouts.app')

@section('meta_title')
    تعديل الكتاب
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">تعديل الكتاب</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form action="{{ auth()->user()->hasRole('admin') ? route('dashboard.books.update', $book->id) : route('dashoard.teacher.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Method spoofing to make it a PUT request --}}

                        <div class="row">
                            <div class="col-12">
                                
                                <div class="form-group">
                                    <label>الاسم <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control"
                                            data-validation-required-message="This field is required" value="{{$book->name}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>الوصف <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="description" class="form-control"
                                            data-validation-required-message="This field is required" value="{{$book->description}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>السعر <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="price" class="form-control"
                                            data-validation-required-message="This field is required" value="{{$book->price}}">
                                    </div>
                                </div>

                                <div class="form-group">
									<label>المدرس <span class="text-danger">*</span></label>
									<div class="controls">
										<select class="form-control select2" style="width: 100%;" name="teacher_id" id="teacher">
                                            <option>اختر المدرس</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" @if($book->teacher_id == $teacher->id) selected @endif>{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
									</div>
								</div>

                                
                                <div class="form-group">
									<label>المرحله <span class="text-danger">*</span></label>
									<div class="controls">
										<select class="form-control select2" style="width: 100%;" name="grade_id" id="grade">
                                            <option>اختر المرحله</option>
                                            @foreach($grades as $grade)
                                                <option value="{{ $grade->id }}" @if($book->grade_id == $grade->id) selected @endif>{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
									</div>
								</div>

                                <div class="form-group">
									<label>صورة الغلاف <span class="text-danger">*</span></label>
									<div class="controls">
										<input type="file" name="cover" class="form-control" required> 
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
<script>
    $(document).ready(function() {
        const stageSelect = $('#teacher');
        const gradeSelect = $('#grade');
        const allTeachers = @json($teachers);
        console.log(allTeachers);

        stageSelect.change(function() {
            const selectedStageId = $(this).val();
            updateGradeOptions(selectedStageId);
        });

        function updateGradeOptions(stageId) {
            gradeSelect.empty(); // Clear existing options

            // Add a default option
            gradeSelect.append($('<option>', {
                value: '',
                text: 'اختر المرحله'
            }));

            let addedGradeIds = []; // Array to keep track of added grade IDs

            $.each(allTeachers, function(i, teacher) {
                if (teacher.id == stageId) {
                    $.each(teacher.subjects, function(index, subject) {
                        // Check if the grade ID has not been added yet
                        if (!addedGradeIds.includes(subject.grade.id)) {
                            gradeSelect.append($('<option>', {
                                value: subject.grade.id,
                                text: subject.grade.name
                            }));
                            // Add the grade ID to the tracking array to avoid duplicates
                            addedGradeIds.push(subject.grade.id);
                        }
                    });
                }
            });


            // If you are using Select2, refresh it after updating the options
            gradeSelect.trigger('change');
        }
    });
</script>
@endpush
