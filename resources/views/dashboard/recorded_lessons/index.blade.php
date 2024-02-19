@extends('dashboard.layouts.app')
@push('page_styles')

@endpush
@section('content')
<div class="col-12">
    <div class="box">
        {{-- @php
            return dd(Auth::user()->givePermissionTo('recorded-lesson-list'));
        @endphp --}}
        <div class="d-flex align-items-center logo-box justify-content-between box-header with-border">
            <h4 class="box-title">الدروس المسجله</h4>
            @can('recorded-lesson-list')
                <a href="{{ route('dashboard.grades.create') }}" class="waves-effect waves-light btn btn-primary mb-5">إضافه</a>
            @endcan
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th scope="col">الصورة</th>
                            <th scope="col">العنوان</th>
    
                            {{-- <th>الصف الدراسي</th> --}}
                            <th scope="col">المادة</th>
                            <th scope="col">خيارات</th>
                        </tr>
                    </thead>
                    <tbody>
    
                        @foreach ($lessons as $index => $lesson)
                        <tr>
                            <td>
                                <img class="iamgeborder" src="{{$lesson->getFirstMedia('lessons') != null ? $lesson->getFirstMedia('lessons')->getUrl() : ''}}" height="80"/>
                            </td>
                            <td>
                                {{ $lesson->name }}
                            </td>
                            {{-- <td>
                                {{ $lesson->stage->name }}
                            </td> --}}
                            <td>
    
                                {{ $lesson->subject->name }}
    
                            </td>
                            <td>
                                @can('recorded-lesson-list')
                                <a href="{{ route('dashboard.recorded-lessons.edit', $lesson->id) }}"  class="waves-effect waves-light btn btn-primary" title="تعديل">
                                    <i class="fa fa-edit"></i>
                                </a>
                                @endcan
                                @can('recorded-lesson-edit')
                                    <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ route('dashboard.recorded-lessons.destroy', $lesson->id) }}" class="waves-effect waves-light btn btn-danger-light" title="حذف">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form id="delete_form_{{$index}}" action="{{ route('dashboard.recorded-lessons.destroy', $lesson->id) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                @endcan
                            </td>
                        </tr>  
                        @endforeach
                    </tbody>
                </table>
            @if ($lessons->count() == 0)
                <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
                    <div class="m-alert__icon">
                        <i class="flaticon-exclamation m--font-warning"></i>
                    </div>
                    <div class="m-alert__text">
                        لم يتم اضافة بيانات بعد
                    </div>
                </div>
            @endif
            {{-- {!! $lessons->links() !!} --}}
            </div>
        </div>
    </div>

</div>


@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
