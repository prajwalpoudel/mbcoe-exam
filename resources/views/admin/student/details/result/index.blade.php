@extends('admin.student.show')
@section('detail')
    <div class="col-xl-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Result</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <a href="{{ route('admin.student.result.create', $student->id) }}"
                       class="btn btn-primary btn-pill btn-sm">Add</a>
                    <a href="{{ route('admin.student.transcript', $student->id) }}" target="_blank"
                       class="btn btn-success btn-pill btn-sm ml-2">Generate Transcript</a>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="row mb-2">
                            <div class="col-md-3 mt-2">
                                {{ html()->label('View as:') }}
                            </div>
                            <div class="col-md-9">
                                {{ html()->modelForm(null, 'get')->route('admin.student.result', $student->id)->class('kt-form kt-form--label-right')->id('view_mode_form')->open() }}
                                    {{ html()->select('view_mode', ['List' => 'List', 'Transcript' => 'Transcript'], session('view_mode') ?? null)->class($errors->has('view_mode') ? 'form-control is-invalid ml-1' : 'form-control ml-1')->id('view_mode')  }}
                                {{ html()->closeModelForm() }}
                            </div>
                        </div>
                    </div>
                </div>
                @if(session('view_mode') == 'Transcript')
                    @include('admin.student.details.result.transcript-view')
                @else
                    @include('admin.student.details.result.list-view')
                @endif
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-5">
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ url()->previous() }}" type="button" class="btn btn-primary ">Back</a>&nbsp;
                            <a href="{{ route('admin.student.show', $student->id) }}" type="button"
                               class="btn btn-success ">Basic Info</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#view_mode').change(function () {
                $('#view_mode_form').submit();
            });
        });
    </script>
    <script type="application/javascript">
        var url = '{{ route('admin.student.result', $student->id) }}';
        var subjectTable = $('#result-table').DataTable({
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
                {data: 'exam', name: 'exams.name'},
                {data: 'exam_type', name: 'exam_types.name'},
                {data: 'subject', name: 'subjects.name'},
                {data: 'grade', name: 'grade'},
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
