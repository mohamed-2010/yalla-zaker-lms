@extends('dashboard.layouts.app')

@section('meta_title')

@endsection

@section('content')
<div class="col-12">
    <div class="box">
      <div class="d-flex align-items-center logo-box justify-content-between box-header with-border">
        <h4 class="box-title">الاقسام</h4>
        <a href="{{ route('dashboard.categories.create') }}" class="waves-effect waves-light btn btn-primary mb-5">إضافه</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <tbody>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">الصف</th>
                    <th scope="col">الاسم</th>
                    <th scope="col">العمليات</th>
                  </tr>
                </tbody>
                <tbody>
                    @foreach($categories as $key => $category)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $category->grade->name }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a type="button" class="waves-effect waves-light btn btn-primary" href="{{route('dashboard.categories.edit', $category)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a type="button" class="waves-effect waves-light btn btn-danger-light" href="{{route('dashboard.categories.destroy', $category)}}">
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