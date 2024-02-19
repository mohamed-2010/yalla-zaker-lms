@extends('dashboard.layouts.app')
@push('page_styles')

@endpush
@section('content')

<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    الادوار
                </h3>
            </div>
        </div>

        {{-- <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{ route('dashboard.roles.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>اضافة دور</span>
                        </span>
                    </a>
                </li>
                <li class="m-portlet__nav-item"></li>
            </ul>
        </div> --}}

    </div>
    <div class="m-portlet__body">

        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
            <thead>
                <tr>
                    <th>اسم</th>
                    <th>خيارات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $index => $role)
                <tr>

                    <td>{{ $role->name }}</td>

                
            
                    <td>
                        @can('role-edit') 
                        @if($role->name !== 'Admin' and  $role->name !=='superadmin')
                        <a href="{{ route('dashboard.roles.edit', $role->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-roles m-btn--icon m-btn--icon-only m-btn--pill" title="تعديل">
                            <i class="la la-edit"></i>
                        </a>
                        @endif
                        @endcan
                        {{-- <a onclick="event.preventDefault(); document.getElementById('delete_form_{{$index}}').submit();" href="{{ route('dashboard.roles.destroy', $role->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-roles m-btn--icon m-btn--icon-only m-btn--pill" title="حذف">
                            <i class="fa fa-window-close"></i>
                        </a>
                        <form id="delete_form_{{$index}}" action="{{ route('dashboard.roles.destroy', $role->id) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>
 --}}
                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
        @if ($roles->count() == 0)
            <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
                <div class="m-alert__icon">
                    <i class="flaticon-exclamation m--font-warning"></i>
                </div>
                <div class="m-alert__text">
                    لم يتم اضافة بيانات بعد
                </div>
            </div>
        @endif
        {{-- {!! $roles->links() !!} --}}
    </div>

</div>

@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
