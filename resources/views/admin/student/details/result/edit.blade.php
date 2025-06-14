@extends('admin.student.show')
@section('detail')
    <div class="col-xl-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Edit Result of {{$student->user->name}}</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <a href="{{ url()->previous() }}"  type="button" class="btn btn-primary ">Back</a>&nbsp;
                    <a href="{{ route('admin.student.show', $student->id) }}"  type="button" class="btn btn-success ">Basic Info</a>
                </div>
            </div>
            {{ html()->modelForm($result, 'put')->route('admin.result.update', $result->id)->class('kt-form kt-form--label-right')->open() }}
            @include('admin.student.details.result.form', ['formAction' => 'Update'])
            {{ html()->closeModelForm() }}
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            // Initialize all select2 once
            $('#semester').select2({ placeholder: 'Select Semester', allowClear: true });
            $('#subject').select2({ placeholder: 'Select Subject', allowClear: true });

            const selectedSemester = @json($result->subject->semester ?? null);
            const selectedSubject = @json($result->subject ?? null);
            const facultyId = $('#faculty').val();
            const semesterId = $('#semester').val();
            const syllabusId = $('#syllabus').val();
            if (facultyId) {
                getSemestersByFaculty(facultyId, selectedSemester);
            }
            if (semesterId && syllabusId) {
                getSubjectsBySemesterandSyllabus(semesterId, syllabusId, selectedSubject);
            }
            $('#faculty').on('change', function () {
                const facultyId = $(this).val();
                getSemestersByFaculty(facultyId);
            });

            $('#semester').on('change', function () {
                $('#subject').empty().trigger('change');
                const semesterId = $('#semester').val();
                const syllabusId = $('#syllabus').val();
                if (semesterId && syllabusId) {
                    getSubjectsBySemesterandSyllabus(semesterId, syllabusId, selectedSubject);
                }
            });
        });

        // AJAX version (no $.getJSON)
        function getSemestersByFaculty(facultyId, selected = null) {
            $('#semester').empty().trigger('change');
            $('#semester').append(new Option('', '', true, true)).trigger('change');
            $.ajax({
                url: `/admin/api/faculty/${facultyId}/semesters`,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    data.forEach(item => {
                        $('#semester').append(new Option(item.name, item.id));
                    });
                    if (selected) {
                        $('#semester').val(selected.id).trigger('change');
                    }
                }
            });
        }

        function getSubjectsBySemesterandSyllabus(semesterId, syllabusId, selected = null) {
            $('#subject').append(new Option('', '', true, true)).trigger('change');
            $.ajax({
                url: `/admin/api/semester/${semesterId}/syllabus/${syllabusId}/subjects`,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    data.forEach(item => {
                        $('#subject').append(new Option(item.name, item.id));
                    });
                    if (selected) {
                        $('#subject').val(selected.id).trigger('change');
                    }
                }
            });
        }
    </script>
@endpush



