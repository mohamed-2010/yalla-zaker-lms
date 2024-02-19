@extends('dashboard.layouts.app')
@push('page_styles')
<script src="{{ asset('ckeditor') }}/ckeditor.js"></script>
@endpush
@section('content')

<div class="box">
        <div class="box-header with-border">
            <h4 class="box-title">إضافة سؤال</h4>
        </div>
        <div class="box-body">

            <!--begin::Form-->
            <form method="POST" action="{{ auth()->user()->hasRole('admin') ? route('dashboard.questions.store') : route('dashboard.teacher.questions.store') }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="exam_id" value="{{$exam->id}}">

                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label">درجة السؤال</label>
                    <div class="controls">
                        <input type="number" name="grade" value="{{ old('grade') }}" required  class="form-control" >
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label">صورة</label>
                    <div class="controls">
                        <input type="file" name="question_image" class="form-control">
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label">وصف السؤال</label>
                    <div class="controls">
                        <textarea id="editor1" name="question_desc" required class="form-control" >{{ old('question_desc') }}</textarea>
                    </div>
                </div>

                


                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label">الاجابة الصحيحة</label>
                    <div class="controls">
                        <textarea type="text" id="editor2" name="right_answer"  class="form-control" >{{ old('right_answer') }}</textarea>
                        <label class="col-lg-2 col-form-label">صورة</label>
                        <div class="controls">
                            <input type="file" name="right_answer_image" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label"> إجابة إجابة خاطئة</label>
                    <div class="controls">
                        <textarea type="text" id="editor3" name="wrong_answers[]['name']" class="form-control" ></textarea>
                        <label class="col-lg-2 col-form-label">صورة</label>
                        <div class="controls">
                            <input type="file" name="wrong_answers[]['image']" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label"> إجابة إجابة خاطئة</label>
                    <div class="controls">
                        <textarea type="text" id="editor4" name="wrong_answers[]['name']" class="form-control" ></textarea>
                        <label class="col-lg-2 col-form-label">صورة</label>
                        <div class="controls">
                            <input type="file" name="wrong_answers[]['image']" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label"> إجابة إجابة خاطئة</label>
                    <div class="controls">
                        <textarea type="text" id="editor5" name="wrong_answers[]['name']" class="form-control" ></textarea>
                        <label class="col-lg-2 col-form-label">صورة</label>
                        <div class="controls">
                            <input type="file" name="wrong_answers[]['image']" class="form-control">
                        </div>
                    </div>
                </div>


                {{-- <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label">اجابة تفصيلية</label>
                    <div class="col-lg-6">
                        <textarea  name="detailed_answer" class="form-control" >{{ old('detailed_answer') }}</textarea>
                    </div>
                </div> --}}

                {{-- <div class="form-group m-form__group row">
                    <label class="col-lg-2 col-form-label">صورة الاجابة</label>
                    <div class="col-lg-6">
                        <input type="file" name="answer_image" class="form-control">
                    </div>
                </div> --}}


                <div class="text-xs-left">
                    <button type="submit" class="btn btn-info">إضافه</button>
                </div>

            </form>

            <!--end::Form-->
        </div>
</div>

@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

    @if (old('type') == 1)
        <script>
            $("#complete_answer").hide();
            $("#mcq_answer").hide();
        
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
        
        
                
            });
        </script>
    @elseif(old('type') == 2)
        <script>
            $("#mcq_answer").hide();
        
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
        
        
                
            });
        </script>
    @else

        <script>
            $("#complete_answer").hide();
            $("#mcq_answer").hide();
        
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
        
        
                
            });
        </script>
    @endif



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

