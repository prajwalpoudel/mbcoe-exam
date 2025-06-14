@extends('admin.layouts.master')
@section('title')
    Result Create
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Result Create
                </h3>
            </div>
        </div>
        {{ html()->modelForm(null, 'post')->route('admin.result.store')->class('kt-form kt-form--label-right')->open() }}
            @include('admin.result.form', ['formAction' => 'Save'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
@push('script')
    @push('script')
        <script>
            $(document).ready(function () {
                // Initialize all select2 once
                $('#semester').select2({ placeholder: 'Select Semester', allowClear: true });
                $('#subject').select2({ placeholder: 'Select Subject', allowClear: true });
                $('#student').select2({ placeholder: 'Select Student', allowClear: true });

                const selectedSemester = @json($result->subject->semester ?? null);
                const selectedSubject = @json($result->subject ?? null);
                const selectedStudent = @json($result->student ?? null);
                const facultyId = $('#faculty').val();
                const semesterId = $('#semester').val();
                const syllabusId = $('#syllabus').val();
                if (facultyId) {
                    getSemestersByFaculty(facultyId, selectedSemester);
                    getStudentsByFaculty(facultyId, selectedStudent);
                }
                if (semesterId && syllabusId) {
                    getSubjectsBySemesterandSyllabus(semesterId, syllabusId, selectedSubject);
                }

                $('#faculty').on('change', function () {
                    const facultyId = $(this).val();
                    getSemestersByFaculty(facultyId);
                    getStudentsByFaculty(facultyId);
                });

                $('#semester, #syllabus').on('change', function () {
                    $('#subject').empty().trigger('change');
                    const semesterId = $('#semester').val();
                    const syllabusId = $('#syllabus').val();
                    if (semesterId && syllabusId) {
                        getSubjectsBySemesterandSyllabus(semesterId, syllabusId, selectedSubject);
                    }
                });

                $('#student').on('change', function (e) {
                    if($(this).val()) {
                        getSyllabusValue($(this).val(), e);
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

            function getStudentsByFaculty(facultyId, selected = null) {
                $('#student').empty().trigger('change');
                $('#student').append(new Option('', '', true, true)).trigger('change');

                $.ajax({
                    url: `/admin/api/faculty/${facultyId}/students`,
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        data.forEach(item => {
                            $('#student').append(new Option(item.user.name, item.id));
                        });
                        if (selected) {
                            $('#student').val(selected.id).trigger('change');
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

            function getSyllabusValue(studentId, e) {
                e.preventDefault();
                $.ajax({
                    url: `/admin/api/student/${studentId}/syllabus`,
                    method: 'GET',
                    success: function (result) {
                        $('#syllabus').val(result).trigger('change');
                    }
                });
            }
        </script>
    @endpush
@endpush
