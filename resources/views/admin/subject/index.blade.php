@extends('admin.layouts.master')
@section('title')
    Subject Listing
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                {{--                <span class="kt-portlet__head-icon">--}}
                {{--                    <i class="flaticon-calendar"></i>--}}
                {{--                </span>--}}
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Subject Listing
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <a href="{{ route('admin.subject.create') }}" class="btn btn-success btn-pill btn-sm">
                        Create
                    </a>
                    <a href="{{ route('admin.subject.import') }}" class="btn btn-primary btn-pill btn-sm">
                        <i class="la la-upload"></i>
                        Import
                    </a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row align-items-center">
                <div class="col-xl-12 order-2 order-xl-1">
                    <div class="row align-items-center">
                        <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-form__group kt-form__group--inline">
                                <div class="kt-form__label">
                                    <label>Faculty:</label>
                                </div>
                                <div class="kt-form__control">
                                    {{ html()->select('faculty_id', $faculties, null)->id('faculty')->class($errors->has('faculty_id') ? 'form-control is-invalid bootstrap-select' : 'form-control bootstrap-select')  }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-form__group kt-form__group--inline">
                                <div class="kt-form__label">
                                    <label>Semester :</label>
                                    {{ html()->select('semester_id', $semesters, null)->id('semester')->class($errors->has('semester_id') ? 'form-control is-invalid bootstrap-select' : 'form-control bootstrap-select')  }}
                                </div>
                                <div class="kt-form__control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-form__group kt-form__group--inline">
                                <div class="kt-form__label">
                                    <label>Syllabus :</label>
                                    {{ html()->select('syllabus_id', $syllabi, null)->id('syllabus')->class($errors->has('syllabus_id') ? 'form-control is-invalid bootstrap-select' : 'form-control bootstrap-select')  }}
                                </div>
                                <div class="kt-form__control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <table
                        class="table table-striped table-bordered table-hover table-responsive table-checkable order-column dataTable no-footer"
                        width="100%" id="subject-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Faculty</th>
                            <th>Semester</th>
                            <th>Syllabus</th>
                            <th>Course Code</th>
                            <th>Credit Hour</th>
                            <th style="text-align: center">Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="application/javascript">
        var url = '{{ route('admin.subject.index') }}';
        var subjectTable = $('#subject-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            searching: true,
            stateSave: true,
            ajax: {
                url: url,
                data: function (d) {
                    d.faculty = $('#faculty').val(),
                        d.semester = $('#semester').val(),
                        d.syllabus = $('#syllabus').val()
                },
            },
            order: [[1, 'asc']],
            columns: [
                {data: 'DT_RowIndex', searchable: false, orderable: false, width: '5%'},
                {data: 'name', name: 'name'},
                {data: 'faculty', name: 'faculties.name'},
                {data: 'semester', name: 'semesters.name'},
                {data: 'syllabus', name: 'syllabi.name'},
                {data: 'code', name: 'code'},
                {data: 'credit_hour', name: 'credit_hour'},
                {data: 'action', 'name': 'action', searchable: false, orderable: false, className: 'dt-body-center'}
            ],
        });
        $(document).ready(function () {
            $('#faculty').change(function () {
                subjectTable.draw();
            });
            $('#semester').change(function () {
                subjectTable.draw();
            });
            $('#syllabus').change(function () {
                subjectTable.draw();
            });

        });
    </script>
@endpush

