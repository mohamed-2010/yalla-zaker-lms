@extends('dashboard.layouts.app')
@push('page_styles')
    <link href="{{ asset('metronic/default') }}/assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12">
    <div class="box">
        <div class="m-portlet__head-caption">
            <div class="d-flex align-items-center logo-box justify-content-between box-header with-border">
                <h4 class="box-title">عمليات تسجيل الدخول</h4>
                @can('student-create')
                    <a href="{{ route('dashboard.students.index') }}" class="waves-effect waves-light btn btn-primary mb-5">جميع الطلاب</a>
                @endcan
            </div>
        </div>

        <div class="box-body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" >

                

                <thead>
                    <tr>
                        <th>time</th>

                        <th>platform name</th>
                        <th>platform family</th>
                        {{-- <th>platform version</th> --}}

                        <th>browser name</th>
                        <th>browser family</th>
                        {{-- <th>browser version</th> --}}

                        <th>device family</th>
                        <th>device model</th>
                        {{-- <th>mobile grade</th> --}}

                    
                    </tr>
                </thead>
                <tbody>

                @foreach ($sessions as $index => $session)
                <tr>
                        <td>{{ $session->created_at }}</td>


                        <td>{{ $session->platform_name }}</td>
                        <td>{{ $session->platform_family }}</td>
                        {{-- <td>{{ $session->platform_version }}</td> --}}

                        <td>{{ $session->browser_name }}</td>
                        <td>{{ $session->browser_family }}</td>
                        {{-- <td>{{ $session->browser_version }}</td> --}}

                        <td>{{ $session->device_family }}</td>
                        <td>{{ $session->device_model }}</td>
                        {{-- <td>{{ $session->mobile_grade }}</td> --}}

                    
                    </tr>  
                @endforeach

                </tbody>
            </table>
            
            {!! $sessions->links() !!}

        </div>
    </div>
    
</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')

@endpush
