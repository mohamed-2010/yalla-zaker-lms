@extends('dashboard.layouts.app')
@push('page_styles')

@endpush
@section('content')

<div class="col-12">
    <div class="box">
        <div class="d-flex align-items-center logo-box justify-content-between box-header with-border">
            <h4 class="box-title">الامتحانات الدورية - الاجابات</h4>
            <a href="{{  auth()->user()->hasRole('admin') ? route('dashboard.exams.index') : route('dashboard.teacher.exams.index') }}" class="waves-effect waves-light btn btn-primary mb-5">جميع الامتحانات</a>
        </div>

        <div class="box-body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                <thead>
                    <tr>
                        <th>اسم الطالب</th>
                        <th>الدرجة</th>
                        <th>خيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exam->answers as $index => $answer)
                    <tr>
                        <td>{{ $answer->user->first_name }} {{ $answer->user->last_name }}</td>
                        <td>{{ $answer->student_grade }}</td>
                        <td></td>
    
                    </tr>  
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
