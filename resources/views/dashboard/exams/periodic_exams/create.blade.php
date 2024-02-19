@extends('dashboard.layouts.app')
@push('page_styles')

@endpush
@section('content')

<div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">إضافة امتحان</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col">
                    <form method="POST" action="{{  auth()->user()->hasRole('admin') ? route('dashboard.exams.store') : route('dashboard.teacher.exams.store') }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>الاسم <span class="text-danger">*</span></label>
                            <div class="controls">
                                <input type="text" name="name" class="form-control" required> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label>المدرس <span class="text-danger">*</span></label>
                            <div class="controls">
                                <select class="form-control select2" style="width: 100%;" name="teacher_id" id="teacher">
                                    <option>اختر المدرس</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" @if (old('teacher_id') == $teacher->id) selected @endif>{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label>الماده <span class="text-danger">*</span></label>
                            <div class="controls">
                                <select class="form-control select2" style="width: 100%;" name="subject_id" id="subject">
                                    
                                </select>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <label class="col-lg-2 col-form-label">مدة الامتحان بالدقيقة</label>
                            <div class="controls">
                                <input type="number" required name="time" value="{{ old('time') }}" class="form-control" >
                            </div>
                        </div>

                        <div class="text-xs-left">
                            <button type="submit" class="btn btn-info">إضافه</button>
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
        const teacherSelect = $('#teacher');
        const subjectSelect = $('#subject');
        const allTeachers = @json($teachers);

        teacherSelect.change(function() {
            const selectedTeacherId = $(this).val();
            updateTeacherOptions(selectedTeacherId);
        });

        function updateTeacherOptions(teacherId) {
            subjectSelect.empty(); // Clear existing options

            // Add a default option
            subjectSelect.append($('<option>', {
                value: '',
                text: 'اختار ماده'
            }));

            // Filter and append options based on the selected stage
            $.each(allTeachers, function(i, teacher) {
                if (teacher.id == teacherId) {
                    $.each(teacher.subjects, function(index, subject) {
                        subjectSelect.append($('<option>', {
                            value: subject.id,
                            text: subject.grade.name + " - " + subject.name
                        }));
                    });
                }
            });

            // If you are using Select2, refresh it after updating the options
            subjectSelect.trigger('change');
        }
    });
</script>

@endpush

