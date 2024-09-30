@extends('admin.layouts.master')
@section('title')
    Result Listing
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                {{--                <span class="kt-portlet__head-icon">--}}
                {{--                    <i class="flaticon-calendar"></i>--}}
                {{--                </span>--}}
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Result Listing
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <a href="{{ route('admin.result.import') }}" class="btn btn-primary btn-pill btn-sm">
                        <i class="la la-upload"></i>
                        Import
                    </a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-striped table-bordered table-hover table-responsive table-checkable order-column dataTable no-footer" width="100%" id="result-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Exam Year</th>
                    <th>Exam Type</th>
                    <th>Faculty</th>
                    <th>Semester</th>
                    <th>Appearence</th>
                    <th style="text-align: center">Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script type="application/javascript">
        var url = '{{ route('admin.result.index') }}';
        var resultTable = $('#result-table').DataTable({
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
                {data: 'exam', name: 'exam'},
                {data: 'exam_type', name: 'exam_type'},
                {data: 'faculty', name: 'faculty'},
                {data: 'semester', name: 'semester'},
                {data: 'result_count', name: 'result_count'},
                {data: 'action', 'name': 'action', searchable: false, orderable: false, className: 'dt-body-center'}
            ],
        });
    </script>
@endpush

