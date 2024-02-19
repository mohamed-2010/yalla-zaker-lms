@extends('dashboard.layouts.app')
@push('page_styles')
<script src="{{ asset('ckeditor') }}/ckeditor.js"></script>

@endpush
@section('content')

<div class="box">
    <div class="box-header with-border">
        <h4 class="box-title">الامتحانات - تعديل السؤال</h4>
        <a href="{{ auth()->user()->hasRole('admin') ? route('dashboard.questions.examQuestions', $question->exam_id) : route('dashboard.teacher.questions.examQuestions', $question->exam_id) }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
            <span>
                <i class="fa fa-stream"></i>
                <span>جميع الأسئلة</span>
            </span>
        </a>
    </div>
    <div class="box-body">

            <!--begin::Form-->
            <form method="POST" action="{{ auth()->user()->hasRole('admin') ? route('dashboard.questions.update', $question->id) : route('dashboard.teacher.questions.update', $question->id) }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label">درجة السؤال</label>
                    <div class="col-lg-8">
                        <input type="number" name="grade" value="{{ $question->grade }}"  class="form-control m-input m-input--solid" >
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label">تغير الصورة</label>
                    <div class="col-lg-8">
                        <input type="file" name="question_image" class="form-control m-input m-input--solid">
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label">وصف السؤال</label>
                    <div class="col-lg-8">
                        <textarea id="editor1" name="question_desc" required class="form-control m-input m-input--solid" >{!! $question->question_desc !!}</textarea>
                    </div>
                </div>


                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label">الاجابة الصحيحة</label>
                    <div class="col-lg-8">
                        <textarea type="text" id="editor2" name="right_answer" class="form-control m-input m-input--solid" >{!! $question->right_answer->desc !!}</textarea>
                    </div>
                </div>

                @foreach ($question->wrong_answers as $index => $wrong_answer)
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label"> إجابة خاطئة</label>
                        <div class="col-lg-8">
                            <textarea type="text" id="editor{{(3 + $index)}}" name="wrong_answers[{{$wrong_answer->id}}]"  class="form-control m-input m-input--solid" >{!!$wrong_answer->desc!!}</textarea>
                        </div>
                    </div>
                @endforeach
        

                {{-- <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label">اجابة تفصيلية</label>
                    <div class="col-lg-6">
                        <textarea  name="detailed_answer" class="form-control m-input m-input--solid" >{{ $question->detailed_answer }}</textarea>
                    </div>
                </div> --}}

                {{-- <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label">تغير صورة الاجابة</label>
                    <div class="col-lg-6">
                        <input type="file" name="answer_image" class="form-control m-input m-input--solid">
                    </div>
                </div> --}}


                <div class="text-xs-left">
                    <button type="submit" class="btn btn-info">حفظ</button>
                </div>
            </form>

        <!--end::Portlet-->            
    </div>
</div>

@endsection

@push('page_vendors')

@endpush

@push('page_scripts')
<script>

    $(document).ready(function () {

        var ckbox = $('#type_mcq');
        $('#type_mcq').on('click',function () {
            if (ckbox.is(':checked')) {
                $("#mcq_answer").show();
                $("#complete_answer").hide();
            }
        });

        var ckbox2 = $('#type_complete');
        $('#type_complete').on('click',function () {
            if (ckbox2.is(':checked')) {
                $("#complete_answer").show();
                $("#mcq_answer").hide();
            }
        });

        // var ckbox3 = $('#type_written');
        // $('#type_written').on('click',function () {
        //     if (ckbox3.is(':checked')) {
        //         $("#complete_answer").hide();
        //         $("#mcq_answer").hide();
        //     }
        // });

        
    });
</script>

{{-- <script>
    CKEDITOR.replace('editor1', {
        language: 'ar'
    });
    CKEDITOR.replace('editor2', {
        language: 'ar'
    });
    CKEDITOR.replace('editor3', {
        language: 'ar'
    });
    CKEDITOR.replace('editor4', {
        language: 'ar'
    });
    CKEDITOR.replace('editor5', {
        language: 'ar'
    });
</script> --}}
@endpush

