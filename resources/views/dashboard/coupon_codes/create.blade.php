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
                    <form id="couponeForm" action="{{ auth()->user()->hasRole('admin') ? route('dashboard.coupone_codes.store') : route('dashboard.teacher.coupone_codes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div id="videoCountError" class="text-danger" style="display: none;"></div>
                        </div>
                        <div class="row">
                            <div class="col-12">

                                <div class="form-group">
                                    <label>اول ثلاث احرف <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="first_code_stage" class="form-control" max="3"
                                            data-validation-required-message="This field is required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>العدد <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="number" name="count" class="form-control"
                                            data-validation-required-message="This field is required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>عدد ايام استخدام الكود <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="number" name="count_of_days" class="form-control"
                                            data-validation-required-message="This field is required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>عدد المشاهدات المسموحه <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="number" name="count_of_views" class="form-control"
                                            data-validation-required-message="This field is required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>عدد الفيديوهات المسموح بها<span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="number" name="video_count" class="form-control"
                                            data-validation-required-message="This field is required">
                                    </div>
                                </div>
                                
                                @if(auth()->user()->hasRole('admin'))
                                    <!-- Teacher -->
                                    <div class="form-group">
                                        <label>المدرس <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <select class="form-control select2" style="width: 100%;" name="teacher_id" id="teacher">
                                                <option>اختر المدرس</option>
                                                @foreach($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @else
                                    <input type="text" name="teacher_id" value="{{auth()->user()->id}}" hidden>
                                @endif

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">الفيديوهات</label>
                                    <div class="col-lg-6">
                                        <select name="video_ids[]" required multiple class="form-control select2" style="width: 100%;" id="videos">
                                            
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

<script>
$(document).ready(function() {
    const stageSelect = $('#teacher');
    const videoSelect = $('#videos');
    const allTeachers = @json($teachers);
    const videoCountInput = $('input[name="video_count"]');
    const couponeForm = $('#couponeForm');
    const videoCountError = $('#videoCountError');

    @if(auth()->user()->hasRole('admin'))
        stageSelect.change(function() {
            const selectedStageId = $(this).val();
            updateGradeOptions(selectedStageId);
        });
    @else
        updateGradeOptions({{auth()->user()->id}});
    @endif

    function updateGradeOptions(stageId) {
        videoSelect.empty(); // Clear existing options

        $.each(allTeachers, function(i, teacher) {
            if (teacher.id == stageId) {
                $.each(teacher.recorded_lessons, function(index, subject) {
                    videoSelect.append($('<option>', {
                        value: subject.id,
                        text: subject.name
                    }));
                });
            }
        });

        // Refresh the Select2 after updating the options
        videoSelect.trigger('change');
    }

    // Form submission handler
    couponeForm.submit(function(e) {
        const selectedVideosCount = videoSelect.val().length;
        const maxVideosCount = parseInt(videoCountInput.val(), 10);
        console.log(selectedVideosCount != maxVideosCount);

        // Check if the count of selected videos is more than the allowed count
        if (selectedVideosCount != maxVideosCount) {
            e.preventDefault(); // Prevent form submission
            videoCountError.text('عدد الفيديوهات المختارة أكثر من العدد المسموح به.').show();
        } else {
            videoCountError.hide();
        }
    });
});

</script>

@endpush