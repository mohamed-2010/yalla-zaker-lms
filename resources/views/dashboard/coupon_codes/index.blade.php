@extends('dashboard.layouts.app')

@section('meta_title')

@endsection

@section('content')
<div class="col-12">
    <div class="box">
      <div class="d-flex align-items-center logo-box justify-content-between box-header with-border">
        <h4 class="box-title">الاكواد</h4>
        <a href="{{ auth()->user()->hasRole('admin') ? route('dashboard.coupone_codes.create') : route('dashboard.teacher.coupone_codes.create') }}" class="waves-effect waves-light btn btn-primary mb-5">إضافه</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <tbody>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">الكود</th>
                    <th scope="col">العمليات</th>
                  </tr>
                </tbody>
                <tbody>
                    @foreach($couponCodes as $key => $couponeCode)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $couponeCode->code }}</td>
                            <td>
                                {{-- <a type="button" class="waves-effect waves-light btn btn-primary" href="{{route('dashboard.coupone_codes.edit', $couponeCode)}}">
                                    <i class="fa fa-edit"></i>
                                </a> --}}
                                <a type="button" class="waves-effect waves-light btn btn-danger-light" href="{{ auth()->user()->hasRole('admin') ? route('dashboard.coupone_codes.destroy', $couponeCode) : route('dashboard.teacher.coupone_codes.destroy', $couponeCode)}}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
          </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
@endsection