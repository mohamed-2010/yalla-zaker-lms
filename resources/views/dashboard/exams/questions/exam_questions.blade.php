
@extends('dashboard.layouts.app')
@push('page_styles')
<style>
.exam_td {
    max-width: 350px !important;
    font-size: 12px !important;
    font-weight: 400 !important;
}
.exam_answer {
    max-width: 80px !important;
    font-size: 12px !important;
    font-weight: 400 !important;
}
</style>
@endpush
@section('content')



<div class="col-12">
    <div class="box">
        <div class="d-flex align-items-center logo-box justify-content-between box-header with-border">
            <h4 class="box-title">الاسئلة</h4>
            <a href="{{ auth()->user()->hasRole('admin') ? route('dashboard.questions.create', $exam->id) : route('dashboard.teacher.questions.create', $exam->id) }}" class="waves-effect waves-light btn btn-primary mb-5">اضافة سؤال</a>
        </div>

        <div class="box-body">
            <div class="m-section__content">
                <div class="alert m-alert--default" role="alert">
                    {{ $exam->desc }}
                </div>
               
            </div>
           
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                <thead>
                    <tr>
                        <th>الكود</th>
                        <th>السؤال</th>
                        <th>الدرجة</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exam->questions as $index => $question)
                    <tr>
                        <td>{{ $question->id }}#</td>
    
                        <td>{!! $question->question_desc !!}</td>
                        
                        <td>{{ $question->grade }}</td>
                        
                        <td>
                            <a href="{{ auth()->user()->hasRole('admin') ? route('dashboard.questions.edit', $question->id) : route('dashboard.teacher.questions.edit', $question->id) }}" class="waves-effect waves-light btn btn-social-icon btn-foursquare" title="تعديل">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ auth()->user()->hasRole('admin') ? route('dashboard.questions.destroy', $question->id) : route('dashboard.teacher.questions.destroy', $question->id) }}" class="waves-effect waves-light btn btn-danger-light" title="حذف">
                                <i class="fa fa-trash"></i>
                            </a>
                            <form id="delete_form_{{$index}}" action="{{ auth()->user()->hasRole('admin') ? route('dashboard.questions.destroy', $question->id) : route('dashboard.teacher.questions.destroy', $question->id) }}" method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                            </form>
    
                        </td>
                    </tr>  
                    @endforeach
                </tbody>
            </table>
            @if ($exam->questions->count() == 0)
                <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
                    <div class="m-alert__icon">
                        <i class="flaticon-exclamation m--font-warning"></i>
                    </div>
                    <div class="m-alert__text">
                        لم يتم اضافة بيانات بعد
                    </div>
                </div>
            @endif
            {{-- {!! $questions->links() !!} --}}
        </div>

    </div>

</div>

@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
