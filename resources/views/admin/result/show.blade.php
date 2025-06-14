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
                    Result Listing: {{ ($result->exam->exam_name ?? null).' '.($result->student->faculty->name ?? null).' '.($result->subject->semester->name ?? null) }}
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <a href="{{ route('admin.result.create') }}" class="btn btn-primary btn-pill btn-sm">
                        <i class="la la-plus"></i>
                        Create
                    </a>
                    <a href="{{ route('admin.result.import') }}" class="btn btn-primary btn-pill btn-sm">
                        <i class="la la-upload"></i>
                        Import
                    </a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped table-bordered table-hover table-responsive dataTable no-footer" width="100%" id="result-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Exam</th>
                            <th>Exam Type</th>
                            <th>Subject</th>
                            <th>Grade</th>
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
        var url = '{{ route('admin.result.show', $id) }}';
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
                {data: 'name', name: 'users.name'},
                {data: 'exam', name: 'exams.name'},
                {data: 'exam_type', name: 'exam_types.name'},
                {data: 'subject', name: 'subjects.name'},
                {data: 'grade', name: 'grade'},
                {data: 'action', 'name': 'action', searchable: false, orderable: false, className: 'dt-body-center'}
            ],
        });
    </script>
@endpush

