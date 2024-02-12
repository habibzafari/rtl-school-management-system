@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>لیست اختصاص کلاس به استاد</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: left">
                        <a href="{{ url('admin/assign_class_teacher/add') }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> ایجاد
                             کلاس به استاد </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">

                        @include('_message')

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">تعداد رشته اختصاصی ها: {{ $getRecord->total() }}</h3>
                                {{-- <h3 class="card-title">تعداد کلاس های داده شده به استاد: </h3> --}}
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم کلاس</th>
                                            <th>اسم استاد</th>
                                            <th>حالت</th>
                                            <th>ایجاد کننده</th>
                                            <th>تاریخ ایجاد</th>
                                            <th>تنظیمات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->class_name }}</td>
                                                <td>{{ $value->teacher_name }}</td>
                                                <td @if ($value->status == 0) style="color: green" @else style="color: red"  @endif>
                                                    @if ($value->status == 0)
                                                        فعال
                                                    @else
                                                        غیر فعال
                                                    @endif

                                                </td>
                                                <td>{{ $value->created_by_name }}</td>
                                                <td>{{ $value->created_at ? date('Y/m/d', strtotime($value->created_at)) : '' }}
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/assign_class_teacher/edit/'. $value->id) }}"
                                                        class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                    <a href="{{ url('admin/assign_class_teacher/edit_single/'. $value->id) }}"
                                                        class="btn btn-info">
                                                        Edit Single
                                                    </a>
                                                    <a href="{{ url('admin/assign_class_teacher/delete/'. $value->id) }}"
                                                        class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="padding: 10px">
                                    {{ $getRecord->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection