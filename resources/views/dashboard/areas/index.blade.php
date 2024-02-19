@extends('dashboard.layouts.app')

@section('meta_title')

@endsection

@section('content')
<div class="col-12">
    <div class="box">
      <div class="d-flex align-items-center logo-box justify-content-between box-header with-border">
        <h4 class="box-title">المناطق</h4>
        <a href="{{ route('dashboard.areas.create') }}" class="waves-effect waves-light btn btn-primary mb-5">إضافه</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <tbody>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">المحافظه</th>
                    <th scope="col">الاسم</th>
                    <th scope="col">العمليات</th>
                  </tr>
                </tbody>
                <tbody>
                    @foreach($areas as $key => $area)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $area->government->name }}</td>
                            <td>{{ $area->name }}</td>
                            <td>
                                <a type="button" class="waves-effect waves-light btn btn-primary" href="{{route('dashboard.areas.edit', $area)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a type="button" class="waves-effect waves-light btn btn-danger-light" href="{{route('dashboard.areas.destroy', $area)}}">
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