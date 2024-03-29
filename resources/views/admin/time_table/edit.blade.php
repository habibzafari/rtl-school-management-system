@extends('layouts.app')

@section('content')
    <div class="content-wrapper" style="min-height: 539px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>ویرایش رشته اختصاصی</h1>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">ویرایش رشته اختصاصی</h3>
                            </div>
                            <form action="" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>اسم کلاس</label>
                                        <select class="form-control" name="class_id" required>
                                            <option value="">انتخاب کلاس</option>
                                            @foreach ($getClass as $class)
                                                <option {{ $getRecord->class_id == $class->id ? 'selected' : '' }}
                                                    value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>اسم رشته</label>
                                  
                                            @foreach ($getSubject as $subject)
                                                @php
                                                    $checked = "";
                                                @endphp
                                                @foreach ($getAssignSubjectID as $subjectAssign)
                                                    @if ($subjectAssign->subject_id == $subject->id)
                                                        @php
                                                            $checked = 'checked';
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <div>
                                                    <label style="font-weight: normal;">
                                                        <input type="checkbox" value="{{ $subject->id }}" {{ $checked }} name="subject_id[]">{{ $subject->name }}</label>
                                                </div>
                                            @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>حالت</label>
                                        <select class="form-control" name="status">
                                            <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">فعال
                                            </option>
                                            <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">غیر
                                                فعال</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">ویرایش</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
