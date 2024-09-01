@extends('admin.layouts.master')
@section('title')
    Exam Listing
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                {{--                <span class="kt-portlet__head-icon">--}}
                {{--                    <i class="flaticon-calendar"></i>--}}
                {{--                </span>--}}
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Exam Listing
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <a href="{{ route('admin.exam.create') }}" class="btn btn-success btn-pill btn-sm">
                        Create
                    </a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" width="100%" id="exam-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Exam Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th style="text-align: center">Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script type="application/javascript">
        var url = '{{ route('admin.exam.index') }}';
        var examTable = $('#exam-table').DataTable({
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
                {data: 'name', name: 'name'},
                {data: 'type.name', name: 'type.name'},
                {data: 'start_date', name: 'start_date'},
                {data: 'end_date', name: 'end_date.name'},
                {data: 'action', 'name': 'action', searchable: false, orderable: false, className: 'dt-body-center'}
            ],
        });
    </script>
@endpush

