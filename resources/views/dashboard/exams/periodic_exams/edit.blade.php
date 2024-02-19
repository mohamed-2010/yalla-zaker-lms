@extends('dashboard.layouts.app')
@push('page_styles')

@endpush
@section('content')

<div class="box">
        <div class="m-portlet m-portlet--tab">
            <div class="box-header with-border">
                <h4 class="box-title">تعديل امتحان</h4>
            </div>

            <div class="box-body">
                <!--begin::Form-->
                <form method="POST" action="{{ auth()->user()->hasRole('admin') ? route('dashboard.exams.update', $exam->id) : route('dashboard.teacher.exams.update', $exam->id) }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>الاسم <span class="text-danger">*</span></label>
                        <div class="controls">
                            <input type="text" name="name" class="form-control" value="{{ $exam->name }}" required> 
                        </div>
                    </div>

                    @if(auth()->user()->hasRole('admin'))

                        <div class="form-group">
                            <label>المدرس <span class="text-danger">*</span></label>
                            <div class="controls">
                                <select class="form-control select2" style="width: 100%;" name="teacher_id" id="teacher">
                                    <option>اختر المدرس</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" @if ($exam->teacher_id == $teacher->id) selected @endif>{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    
                    @else
                        
                        <input type="text" name="teacher_id" value="{{auth()->user()->id}}" hidden>

                    @endif

                    
                    <div class="form-group">
                        <label>الماده <span class="text-danger">*</span></label>
                        <div class="controls">
                            <select class="form-control select2" style="width: 100%;" name="subject_id" id="subject">
                                @foreach($subjects as $subject)
                                    @if(in_array($exam->teacher_id, $subject->teachers->pluck(['id'])->toArray()))
                                        <option value="{{ $subject->id }}" @if ($exam->subject_id == $subject->id) selected @endif>{{ $subject->grade->name . " - " . $subject->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">مدة الامتحان بالدقيقة</label>
                        <div class="controls">
                            <input type="number" required name="time" value="{{ $exam->duration }}" class="form-control" >
                        </div>
                    </div>
                    
                    <div class="text-xs-left">
                        <button type="submit" class="btn btn-info">حفظ</button>
                    </div>
                </form>
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

        @if(auth()->user()->hasRole('admin'))

            teacherSelect.change(function() {
                const selectedTeacherId = $(this).val();
                updateTeacherOptions(selectedTeacherId);
            });

        @else
            //updateTeacherOptions({{auth()->user()->id}});
        @endif

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

