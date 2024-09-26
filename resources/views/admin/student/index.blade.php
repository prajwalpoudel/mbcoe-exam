@extends('admin.layouts.master')
@section('title')
    Student Listing
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                {{--                <span class="kt-portlet__head-icon">--}}
                {{--                    <i class="flaticon-calendar"></i>--}}
                {{--                </span>--}}
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Student Listing
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <a href="{{ route('admin.student.create') }}" class="btn btn-success btn-pill btn-sm">
                        <i class="la la-plus"></i>
                        Create
                    </a>
                    <a href="{{ route('admin.student.import') }}" class="btn btn-primary btn-pill btn-sm">
                        <i class="la la-upload"></i>
                        Import
                    </a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row align-items-center">
                <div class="col-xl-8 order-2 order-xl-1">
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
                                    <label>Semeser :</label>
                                    {{ html()->select('semester_id', $semesters, null)->id('semester')->class($errors->has('semester_id') ? 'form-control is-invalid bootstrap-select' : 'form-control bootstrap-select')  }}
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
                    <table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column dataTable no-footer" width="100%" id="student-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Symbol No</th>
                    <th>Registration Number</th>
                    <th>Faculty</th>
                    <th>Semester</th>
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
        var url = '{{ route('admin.student.index') }}';
        var facultyValue = $('#faculty option:selected').text();
        var semesterValue = $('#semester option:selected').text();
        var studentTable = $('#student-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            searching: true,
            stateSave: true,
            ajax: {
                url: url,
                data: function (d) {
                    d.faculty = $('#faculty').val(),
                    d.semester = $('#semester').val()
                },
            },
            dom:"<'col-lg-6 topStart'l><'topEnd'B><'top2end'f>trip",
            buttons: [
                        'pdf',
                        {
                            extend: 'print',
                            title: 'Students Listing of '+  facultyValue +' Faculty '+  semesterValue +' Semester ',
                            exportOptions: {
                                columns: [ 1, 2, 3, 4, 5, 6, 7, 8]
                            },
                        }
            ],

            order: [[1, 'asc']],
            columns: [
                {data: 'DT_RowIndex', searchable: false, orderable: false, width: '5%'},
                {data: 'name', name: 'users.name'},
                {data: 'email', name: 'users.email'},
                {data: 'address', name: 'users.address'},
                {data: 'phone', name: 'users.phone'},
                {data: 'symbol_no', name: 'symbol_no'},
                {data: 'registration_number', name: 'registration_number'},
                {data: 'faculty', name: 'faculties.name'},
                {data: 'semester', name: 'semesters.name'},
                {data: 'action', 'name': 'action', searchable: false, orderable: false, className: 'dt-body-center'}
            ],
        });
        $(document).ready(function() {
            $('#faculty').change(function () {
                studentTable.draw();
            });
            $('#semester').change(function () {
                studentTable.draw();
            });

        });
    </script>
@endpush

