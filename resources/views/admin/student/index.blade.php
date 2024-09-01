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
            <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" width="100%" id="student-table">
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
@endsection

@push('script')
    <script type="application/javascript">
        var url = '{{ route('admin.student.index') }}';
        var sectionTable = $('#student-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            searching: true,
            stateSave: true,
            ajax: {
                url: url,
            },
            order: [[1, 'asc']],
            columns: [
                {data: 'DT_RowIndex', searchable: false, orderable: false, width: '5%'},
                {data: 'user.name', name: 'user.name'},
                {data: 'user.email', name: 'user.email'},
                {data: 'user.address', name: 'user.address'},
                {data: 'user.phone', name: 'user.phone'},
                {data: 'symbol_no', name: 'symbol_no'},
                {data: 'registration_number', name: 'registration_number'},
                {data: 'faculty.name', name: 'faculty.name'},
                {data: 'semester[0].name', name: 'semester[0].name'},
                {data: 'action', 'name': 'action', searchable: false, orderable: false, className: 'dt-body-center'}
            ],
        });
    </script>
@endpush

