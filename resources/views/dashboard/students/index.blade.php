@extends('dashboard.layouts.app')
@push('page_styles')
<link href="{{ asset('metronic/default') }}/assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12">
    <div class="box">
        <div class="m-portlet__head-caption">
            <div class="d-flex align-items-center logo-box justify-content-between box-header with-border">
                <h4 class="box-title">الطلاب</h4>
                @can('student-create')
                    <a href="{{ route('dashboard.students.create') }}" class="waves-effect waves-light btn btn-primary mb-5">اضافة طالب</a>
                @endcan
            </div>
        </div>

        <div class="box-body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable">

                <div class="row justify-content-md-center">
                    <div class="col-lg-6 mt-4">
                        <form method="GET" action="{{route('dashboard.students.find')}}" class="m-form m-form--fit m-form--label-align-right">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-10">
                                        <input name="text" placeholder="يمكن البحث برقم الهاتف او الاسم" value="@if(isset($text)){{ $text }}@endif" class="form-control m-input m-input--solid">
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="submit" class="waves-effect waves-light btn btn-primary mb-5">بحث</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>هاتف الطالب</th>
                        <th>هاتف ولي الامر</th>
                        <th>الاجهزه</th>
                        <th>المحفظه</th>
                        <th>حالة الحساب</th>
                        <th>الخيارات</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($students as $index => $student)
                    <tr>
                        <td>{{ $student->name }}</td>

                        <td>{{ $student->phone }}</td>

                        <td>{{ $student->parent_phone }}</td>

                        @can('student-edit')
                        <td>
                            <a href="{{ route('dashboard.students.sessions', $student->id) }}" class="waves-effect waves-light btn btn-primary-light btn-flat mb-5" title="تعديل">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                        @endcan
                        @can('student-edit')
                        <td>
                            {{ $student->wallet }}
                            <a href="{{ route('dashboard.student.addWalletView', $student->id) }}" class="waves-effect waves-light btn btn-dark mb-5" title="تعديل">
                                <i class="fa fa-plus"></i>
                            </a>
                            <a href="{{ route('dashboard.student.editWalletView', $student->id) }}" class="waves-effect waves-light btn btn-warning mb-5" title="تعديل">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                        @endcan
                        @can('student-edit')
                        <td>
                            @if ($student->account_status == 'new')
                            جديد

                            <a href="{{ route('dashboard.student.account-status-update', ['id' => $student->id, 'status' => 'active' ]) }}" class="btn btn-success">تنشيط</a>
                            <a href="{{ route('dashboard.student.account-status-update', ['id' => $student->id, 'status' => 'ban' ]) }}" class="btn btn-danger">حظر</a>

                            @elseif ($student->account_status == 'active')
                            نشط
                            <a href="{{ route('dashboard.student.account-status-update', ['id' => $student->id, 'status' => 'ban' ]) }}" class="btn btn-danger">حظر</a>
                            @else
                            محظور
                            <a href="{{ route('dashboard.student.account-status-update', ['id' => $student->id, 'status' => 'active' ]) }}" class="btn btn-success">تنشيط</a>
                            @endif
                        </td>
                        @endcan

                        <td>
                            @can('student-edit')
                            <a href="{{ route('dashboard.students.show', $student->id) }}" class="waves-effect waves-light btn btn-primary-light btn-flat mb-5" title="تعديل">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('dashboard.students.edit', $student->id) }}" class="waves-effect waves-light btn btn-warning mb-5" title="تعديل">
                                <i class="fa fa-edit"></i>
                            </a>
                            @endcan
                            @can('student-delete')
                            <a onclick="event.preventDefault(); document.getElementById('{{ 'delete-form-' . $index}}').submit();" href="{{ route('dashboard.students.destroy', $student->id) }}" class="waves-effect waves-light btn btn-danger btn-danger mb-5" title="حذف">
                                <i class="fa fa-trash-o"></i>
                            </a>
                            <form id="delete-form-{{$index}}" action="{{ route('dashboard.students.destroy', $student->id) }}" method="POST" style="display: none;">
                                @method('DELETE')
                                @csrf
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            @if ($students->count() == 0)
            @if(isset($text))
            لم نجد نتائج
            @else
            <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
                <div class="m-alert__icon">
                    <i class="flaticon-exclamation m--font-warning"></i>
                </div>
                <div class="m-alert__text">
                    لم يتم اضافة بيانات بعد
                </div>
            </div>
            @endif

            @endif
            {!! $students->links() !!}

        </div>
    </div>
</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
