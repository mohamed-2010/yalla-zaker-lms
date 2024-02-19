@extends('dashboard.layouts.app')
@push('page_styles')

@endpush
@section('content')
<div class="col-12">
    <div class="box">
        <div class="d-flex align-items-center logo-box justify-content-between box-header with-border">
            <h4 class="box-title">الامتحانات</h4>
            @can('exam-create')
                <a href="{{ auth()->user()->hasRole('admin') ?  route('dashboard.exams.create') : route('dashboard.teacher.exams.create') }}" class="waves-effect waves-light btn btn-primary mb-5">إضافه</a>
            @endcan
        </div>

        <div class="box-body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>الأسئلة</th>
                        <th>الحلول</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exams as $index => $exam)
                    <tr>
                        <td>{{ $exam->name }}</td>
                        <td>{{$exam->questions->count()}}
                            @can('exam-edit')
                            <a href="{{ auth()->user()->hasRole('admin') ? route('dashboard.questions.create', $exam->id) : route('dashboard.teacher.questions.create', $exam->id) }}" class="waves-effect waves-light btn btn-social-icon btn-bitbucket" title="تعديل">
                                <i class="fa fa-plus"></i>
                            </a> 
                            <a href="{{ auth()->user()->hasRole('admin') ? route('dashboard.questions.examQuestions', $exam->id) : route('dashboard.teacher.questions.examQuestions', $exam->id) }}" class="waves-effect waves-light btn btn-social-icon btn-foursquare" title="تعديل">
                                <i class="fa fa-eye"></i>
                            </a>
                            @endcan
                        </td>
                        <td>{{$exam->answers->count()}}
                            @can('exam-edit')
                            <a href="{{ auth()->user()->hasRole('admin') ? route('dashboard.exams.answers', $exam->id) : route('dashboard.teacher.exams.answers', $exam->id) }}" class="waves-effect waves-light btn btn-social-icon btn-foursquare" title="تعديل">
                                <i class="fa fa-eye"></i>
                            </a>
                            @endcan 
                        </td>
                        <td>
                            @can('exam-edit')
                            <a href="{{ auth()->user()->hasRole('admin') ? route('dashboard.exams.edit', $exam->id) : route('dashboard.teacher.exams.edit', $exam->id) }}" class="waves-effect waves-light btn btn-social-icon btn-foursquare" title="تعديل">
                                <i class="fa fa-edit"></i>
                            </a>
                            @endcan 
                            @can('exam-delete')
                            <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ auth()->user()->hasRole('admin') ? route('dashboard.exams.destroy', $exam->id) : route('dashboard.teacher.exams.destroy', $exam->id) }}" class="waves-effect waves-light btn btn-danger-light" title="حذف">
                                <i class="fa fa-trash"></i>
                            </a>
                            <form id="delete_form_{{$index}}" action="{{ auth()->user()->hasRole('admin') ? route('dashboard.exams.destroy', $exam->id) : route('dashboard.teacher.exams.destroy', $exam->id) }}" method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                            </form>
                            @endcan 
                        </td>
                    </tr>  
                    @endforeach
                </tbody>
            </table>
            @if ($exams->count() == 0)
                <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
                    <div class="m-alert__icon">
                        <i class="flaticon-exclamation m--font-warning"></i>
                    </div>
                    <div class="m-alert__text">
                        لم يتم اضافة بيانات بعد
                    </div>
                </div>
            @endif
            {{-- {!! $exams->links() !!} --}}
        </div>
    </div>
</div>

@endsection

