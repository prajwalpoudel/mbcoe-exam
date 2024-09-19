@extends('admin.layouts.master')
@section('title')
    Batch Details
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Batch Details
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-lg-3">
                    <h6>Name : {{ $batch->name }}</h6>
                </div>
                <div class="col-lg-3">
                    <h6>Syllabus : {{ $batch->syllabus->name ?? null }}</h6>
                </div>
                <div class="col-lg-3">
                    <h6>
                        <span>Status :</span>
                        <span class="kt-badge kt-badge--inline kt-badge--success">Running</span>
                    </h6>
                </div>
                <div class="col-lg-3">
                    <h6>No of Students : {{ count($batch->students) }}</h6>
                </div>
            </div>

            <div class="row mt-4">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title kt-font-primary">
                                All Subjects Cleared Students
                            </h3>
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
                                                <label>View upto:</label>
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
                                <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" width="100%" id="result-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Symbol No</th>
                                        <th>Registration Number</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="application/javascript">
        var url = '{{ route('admin.batch.result') }}';
        var batchId = '{{ $batch->id }}'
        var syllabusId = '{{ $batch->syllabus_id }}'
        var sectionTable = $('#result-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            searching: true,
            stateSave: true,
            ajax: {
                url: url,
                data: function (d) {
                        d.batch =  batchId,
                        d.syllabus =  syllabusId,
                        d.faculty = $('#faculty').val(),
                        d.semester = $('#semester').val()
                },
            },
            order: [[1, 'asc']],
            columns: [
                {data: 'DT_RowIndex', searchable: false, orderable: false, width: '5%'},
                {data: 'user.name', name: 'user.name'},
                {data: 'user.email', name: 'user.email'},
                {data: 'user.address', name: 'user.address'},
                {data: 'symbol_no', name: 'symbol_no'},
                {data: 'registration_number', name: 'registration_number'},
                {data: 'action', 'name': 'action', searchable: false, orderable: false, className: 'dt-body-center'}
            ],
        });
        $(document).ready(function() {
            $('#faculty').change(function () {
                sectionTable.draw();
            });
            $('#semester').change(function () {
                sectionTable.draw();
            });
        });
    </script>
@endpush

