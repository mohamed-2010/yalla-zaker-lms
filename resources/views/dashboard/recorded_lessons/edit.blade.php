@extends('dashboard.layouts.app')

@section('meta_title')
    تعديل درس مسجل
@endsection

@section('content')
<div class="box">
    <div class="box-header with-border">
        <h4 class="box-title">تعديل</h4>
    </div>
    <div class="box-body">
        <div class="row">
                <!--begin::Portlet-->
                <div class="col">
                    <!--begin::Form-->
                    <form method="POST" action="{{ route('dashboard.recorded-lessons.update', $RecordedLesson->id) }}" id="videoUploadForm" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12">

                                @if(auth()->user()->hasRole('admin'))

                                    <div class="form-group">
                                        <label class="col-lg-2 col-form-label">المدرس <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <select class="form-control select2" style="width: 100%;" name="teacher_id" id="teacher" required>
                                                <option value="">اختر مدرس</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}" @if ($RecordedLesson->teacher_id == $teacher->id) selected @endif>{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @else
                                    <input type="text" hidden value="{{auth()->user()->id}}" name="teacher_id">
                                @endif

                                <div class="form-group">
									<label>الماده <span class="text-danger">*</span></label>
									<div class="controls">
										<select class="form-control select2" style="width: 100%;" name="subject_id" id="subject" required>
                                            @foreach($subjects as $subject) 
                                                    @if(in_array($RecordedLesson->teacher_id, $subject->teachers->pluck(['id'])->toArray())) 
                                                        <option value="{{ $subject->id }}" @if ( $RecordedLesson->subject_id == $subject->id ) selected="selected" @endif>{{ $subject->grade->name }} - {{ $subject->name }}</option>
                                                    @endif
                                            @endforeach
                                        </select>
									</div>
								</div>

                                
                                <div class="form-group">
									<label>الامتحان <span class="text-danger">*</span></label>
									<div class="controls">
										<select class="form-control select2" style="width: 100%;" name="exam_id" id="exam" required>
                                            <option value="">اختر امتحان</option>
                                            @foreach($exams as $exam) 
                                                    @if(in_array($RecordedLesson->exam_id, $RecordedLesson->subject->exams->pluck(['id'])->toArray())) 
                                                        <option value="{{ $exam->id }}" @if ( $RecordedLesson->exam_id == $exam->id ) selected="selected" @endif>{{ $exam->name }}</option>
                                                    @endif
                                            @endforeach
                                        </select>
									</div>
								</div>

                                <div class="form-group">
                                    <label class="col-lg-2 col-form-label">النوع <span class="text-danger">*</span></label>
                                    <div class="controls">
										<select class="form-control select2" style="width: 100%;" name="type" id="type" required>
                                            <option value="">اختر النوع</option>
                                            <option value="revision" @if ($RecordedLesson->type == "revision") selected @endif>مراجعات</option>
                                            <option value="explain" @if ($RecordedLesson->type == "explain") selected @endif>شرح</option>
                                            <option value="wrokshops" @if ($RecordedLesson->type == "wrokshops") selected @endif>ورش</option>
                                        </select>
									</div>
                                </div>

                                
                                <div class="form-group">
                                    <label class="col-lg-2 col-form-label">الدفع <span class="text-danger">*</span></label>
                                    <div class="controls">
										<select class="form-control select2" style="width: 100%;" name="is_paid" id="is_paid" required>
                                            <option value="">اختر الدفع</option>
                                            <option value="true" @if ($RecordedLesson->is_paid == 1) selected @endif>إشتراك</option>
                                            <option value="false" @if ($RecordedLesson->is_paid == 0) selected @endif>مجاني</option>
                                        </select>
									</div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 col-form-label">السعر <span class="text-danger">*</span></label>
                                    <div class="controls">
										<input type="number" name="price" class="form-control"
                                            data-validation-required-message="This field is required" value="{{ $RecordedLesson->price }}">
									</div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 col-form-label">العنوان <span class="text-danger">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="title" class="form-control"
                                            data-validation-required-message="This field is required" required value="{{$RecordedLesson->name}}">
                                    </div>
                                </div>

                                <div class="form-group m-form__group">
                                    <label class="col-lg-2 col-form-label">صورة الفيديو</label>
                                    <div class="col-lg-6">
                                        <input type="file" name="cover" class="form-control m-input m-input--solid" id="imageInput">
                                    </div>
                                    <!-- Image preview container -->
                                    <img id="imagePreview" src="{{$RecordedLesson->getFirstMedia('lessons') != null ? $RecordedLesson->getFirstMedia('lessons')->getUrl() : ''}}" alt="Image Preview" style="display: none; max-width: 200px; max-height: 200px; margin:10px;" />
                                </div>

                                <div class="form-group m-form__group" id="video_file">
                                    <label class="col-lg-2 col-form-label"> الفيديو <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input type="file" name="video" class="form-control m-input m-input--solid" id="videoInput">
                                    </div>
                                    <div style="height: 15px;"></div>
                                    <div style="position:relative;padding-top:56.25%;" id="old_video">
                                        <iframe src="https://iframe.mediadelivery.net/embed/{{$RecordedLesson->video_library_id}}/{{$RecordedLesson->video_id}}?autoplay=true&loop=false&muted=false&preload=true&responsive=true" loading="lazy" style="border:0;position:absolute;top:0;height:100%;width:100%;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture;" allowfullscreen="true">
                                        </iframe>
                                    </div>
                                    <!-- Video preview container -->
                                    <video id="videoPreview" controls style="display: none; max-width: 300px; margin:10px;">
                                        <source src="#" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>

                                    <div style="height: 15px;"></div>
                                    <div class="progress my-3 mt-5">
                                        <div class="bar"></div >
                                        <div class="percent">0%</div >
                                    </div>

                                </div>

                                <div class="form-group m-form__group">
                                    <label class="col-lg-2 col-form-label">المرفقات</label>
                                    <div class="col-lg-6">
                                        <input type="file" name="atachment" class="form-control m-input m-input--solid" id="imageInput">
                                    </div>
                                    <!-- Image preview container -->
                                    <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 200px; max-height: 200px; margin:10px;" />
                                </div>

                        </div>



                        <div class="text-xs-left">
                            <button type="submit" class="btn btn-info">إضافه</button>
                        </div>

                    </form>

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->
        </div>
    </div>
</div>
@endsection


<style>
    .progress { position:relative; width:100%; }
    .bar { background-color: #6BE69B; width:0%; height:40px; }
    .percent { position:absolute; display:inline-block; left:50%; color: #040608;}
</style>


@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

<script>
$(document).ready(function () {

    // Image preview
    $('#imageInput').change(function() {
        const file = this.files[0];
        if (file) {
            $('#imagePreview').attr('src', URL.createObjectURL(file)).show();
        }
    });

    // Video preview
    $('#videoInput').change(function() {
        const file = this.files[0];
        if (file) {
            const videoPreview = $('#videoPreview');
            const oldVideo = $("#old_video");
            videoPreview.show();
            oldVideo.hide();
            videoPreview.find('source').attr('src', URL.createObjectURL(file));
            videoPreview.get(0).load(); // Reload the video tag to update the source
        }
    });

    // $('#videoUploadForm').submit(function(e) {
    //     e.preventDefault(); // Prevent the default form submission

    //     var formData = new FormData(this); // Create a FormData object, passing the form as a parameter

    //     $.ajax({
    //         url: "{{ route('dashboard.recorded-lessons.store') }}",
    //         type: 'POST',
    //         data: formData,
    //         processData: false, // Tell jQuery not to process the data
    //         contentType: false, // Tell jQuery not to set contentType
    //         xhr: function() {
    //             var xhr = new window.XMLHttpRequest();
    //             xhr.upload.addEventListener("progress", function(evt) {
    //                 if (evt.lengthComputable) {
    //                     var percentComplete = evt.loaded / evt.total;
    //                     percentComplete = parseInt(percentComplete * 100);
    //                     console.log(percentComplete);
    //                     $('.bar').width(percentComplete + '%');
    //                     $('.percent').text(percentComplete + '%');
    //                 }
    //             }, false);
    //             return xhr;
    //         },
    //         success: function(data) {
    //             //$('#uploadStatus').html('<p style="color: green;">Upload successful!</p>');
    //             console.log(data);
    //             alert('تم اضافة الدرس بنجاح');
    //             window.location.href = SITEURL +"/"+"dashboard/lessons";
    //         },
    //         error: function(xhr, status, error) {
    //             //$('#uploadStatus').html('<p style="color: red;">Error during file upload.</p>');
    //             console.log(xhr);
    //             console.log(status);
    //             console.log(error);
    //         }
    //     });
    // });
});
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var SITEURL = "{{URL('')}}";
    $(function() {
        $(document).ready(function()
        {
            var bar = $('.bar');
            var percent = $('.percent');
            $('videoUploadForm').ajaxForm({
                beforeSend: function() {
                    var percentVal = '0%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                complete: function(xhr) {
                    alert('تم تحميل الملف بنجاح');
                    window.location.href = SITEURL +"/"+"dashboard/lessons";
                }
            });
        }); 
    });
</script>

<script>
    $(document).ready(function() {
        const selectedSubject = $('#subject');
        const selectedTeacher = $('#teacher');
        const allTeachers = @json($teachers);
        console.log(selectedTeacher);

        selectedTeacher.change(function() {
            const teacherId = $(this).val();
            updateCategoryOptions(teacherId);
        });

        function updateCategoryOptions(teacherId) {
            selectedSubject.empty(); // Clear existing options

            // Add a default option
            selectedSubject.append($('<option>', {
                value: '',
                text: 'اختار ماده'
            }));

            // Filter and append options based on the selected stage
            $.each(allTeachers, function(i, teacher) {
                if (teacher.id == teacherId) {
                    $.each(teacher.subjects, function(index, subject) {
                        selectedSubject.append($('<option>', {
                            value: subject.id,
                            text: subject.grade.name + " - " + subject.name
                        }));
                    });
                }
            });

            // If you are using Select2, refresh it after updating the options
            selectedSubject.trigger('change');
        }
    });

    $(document).ready(function() {
        const selectedSubject = $('#subject');
        const selectExam = $('#exam');
        const allSubjects = @json($subjects);

        selectedSubject.change(function() {
            const subjectId = $(this).val();
            updateSubjectOptions(subjectId);
        });

        function updateSubjectOptions(subjectId) {
            selectExam.empty(); // Clear existing options

            // Add a default option
            selectExam.append($('<option>', {
                value: '',
                text: 'اختار امتحان'
            }));

            // Filter and append options based on the selected stage
            $.each(allSubjects, function(i, subject) {
                if (subject.id == subjectId) {
                    $.each(subject.exams, function(index, exam) {
                        selectExam.append($('<option>', {
                            value: exam.id,
                            text: exam.name
                        }));
                    });
                }
            });

            // If you are using Select2, refresh it after updating the options
            selectExam.trigger('change');
        }
    });
</script>

@endpush
