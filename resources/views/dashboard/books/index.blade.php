@extends('dashboard.layouts.app')

@section('meta_title')
الكتب
@endsection

@section('content')
<div class="col-12">
    <div class="box">
      <div class="d-flex align-items-center logo-box justify-content-between box-header with-border">
        <h4 class="box-title">الكتب</h4>
        <a href="{{auth()->user()->hasRole('admin') ? route('dashboard.books.create') : route('dashboard.teacher.books.create') }}" class="waves-effect waves-light btn btn-primary mb-5">إضافه</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <tbody>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">الغلاف</th>
                    <th scope="col">الاسم</th>
                    <th scope="col">العمليات</th>
                  </tr>
                </tbody>
                <tbody>
                    @foreach($books as $key => $book)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>
                              <img src="{{ $book->getFirstMedia('books') != null ? $book->getFirstMedia('books')->getUrl() : "" }}"  alt="Book Cover" style="max-width: 70px; max-height: 70px;"/>
                          </td>
                            <td>{{ $book->name }}</td>
                            <td>
                                <a type="button" class="waves-effect waves-light btn btn-primary" href="{{ auth()->user()->hasRole('admin') ? route('dashboard.books.edit', $book) : route('dashboard.teacher.books.edit', $book)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a type="button" class="waves-effect waves-light btn btn-danger-light" href="{{ auth()->user()->hasRole('admin') ? route('dashboard.books.destroy', $book) : route('dashboard.teacher.books.destroy', $book)}}">
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