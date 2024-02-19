@extends('dashboard.layouts.app')

@section('meta_title')
    المدرسين
@endsection

@section('content')
<div class="col-12">
    <div class="box">
      <div class="d-flex align-items-center logo-box justify-content-between box-header with-border">
        <h4 class="box-title">المدرسين</h4>
        <a href="{{ route('dashboard.teachers.create') }}" class="waves-effect waves-light btn btn-primary mb-5">إضافه</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <tbody>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">الاسم</th>
                    <th scope="col">العمليات</th>
                  </tr>
                </tbody>
                <tbody>
                    @foreach($teachers as $key => $teacher)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $teacher->name }}</td>
                            <td>
                                <a type="button" class="waves-effect waves-light btn btn-primary" href="{{route('dashboard.teachers.edit', $teacher)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a type="button" class="waves-effect waves-light btn btn-danger-light" href="{{route('dashboard.teachers.destroy', $teacher)}}">
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