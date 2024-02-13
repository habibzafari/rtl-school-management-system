@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>لیست کلاس و مضمون های من</h1>
                    </div>
                    {{-- <div class="col-sm-6" style="text-align: left">
                        <a href="{{ url('admin/assign_class_teacher/add') }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> ایجاد
                             کلاس به استاد </a>
                    </div> --}}
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        {{-- <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title card-primary">جستجوی رشته اختصاصی</h3>
                            </div>
                            <form action="" method="get" id="searchForm">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="class_name">اسم کلاس</label>
                                            <input type="text" name="class_name" value="{{ Request::get('class_name') }}"
                                                id="class_name" class="form-control" placeholder="اسم کلاس را وارد کنید">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="teacher_name">اسم استاد</label>
                                            <input type="text" name="teacher_name" value="{{ Request::get('teacher_name') }}"
                                                id="teacher_name" class="form-control" placeholder="اسم استاد را وارد کنید">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <button type="submit" class="btn btn-info"
                                                style="margin-top: 33px">جستجو</button>
                                            <a href="{{ url('admin/assign_class_teacher/list') }}" class="btn btn-danger"
                                                style="margin-top: 33px">پاک کردن</a>
                                        </div>
                                    </div>
                            </form>
                        </div> --}}

                        @include('_message')

                        <div class="card card-primary">
                            <div class="card-header">
                                {{-- <h3 class="card-title">تعداد رشته اختصاصی ها: {{ $getRecord->total() }}</h3> --}}
                                <h3 class="card-title">تعداد کلاس های و مضمون ها: </h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>اسم کلاس</th>
                                            <th>اسم مضمون</th>
                                            <th>نوع مضمون</th>
                                            <th>تاریخ ایجاد</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->class_name }}</td>
                                                <td>{{ $value->subject_name }}</td>
                                                <td>{{ $value->subject_type }}</td>
                                                {{-- <td @if ($value->status == 0) style="color: green" @else style="color: red"  @endif>
                                                    @if ($value->status == 0)
                                                        فعال
                                                    @else
                                                        غیر فعال
                                                    @endif

                                                </td> --}}
                                                <td>{{ $value->created_at ? date('Y/m/d', strtotime($value->created_at)) : '' }}
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px">
                                    {{-- {{ $getRecord->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection