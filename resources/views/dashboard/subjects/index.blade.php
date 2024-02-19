@extends('dashboard.layouts.app')

@section('meta_title')
    المواد
@endsection

@section('content')
<div class="col-12">
    <div class="box">
      <div class="d-flex align-items-center logo-box justify-content-between box-header with-border">
        <h4 class="box-title">المواد</h4>
        <a href="{{ route('dashboard.subjects.create') }}" class="waves-effect waves-light btn btn-primary mb-5">إضافه</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <tbody>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">الصوره</th>
                    <th scope="col">الصف</th>
                    <th scope="col">القسم</th>
                    <th scope="col">الاسم</th>
                    <th scope="col">العمليات</th>
                  </tr>
                </tbody>
                <tbody>
                    @foreach($subjects as $key => $subject)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>
                              <img src="{{ $subject->getFirstMedia('subjects') != null ? $subject->getFirstMedia('subjects')->getUrl() : "" }}"  alt="Subject Cover" style="max-width: 70px; max-height: 70px;"/>
                            </td>
                            <td>{{ $subject->grade->name }}</td>
                            <td>
                              @foreach($subject->categories as $category)
                                {{ $category->name }}
                              @endforeach
                            </td>
                            <td>{{ $subject->name }}</td>
                            <td>
                                <a type="button" class="waves-effect waves-light btn btn-primary" href="{{route('dashboard.subjects.edit', $subject)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a type="button" class="waves-effect waves-light btn btn-danger-light" href="{{route('dashboard.subjects.destroy', $subject)}}">
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