@extends('admin.layouts.master')
@section('title')
    Student Edit
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Student Edit
                </h3>
            </div>
        </div>
        {{ html()->modelForm($student, 'put')->route('admin.student.update', $student)->class('kt-form kt-form--label-right')->open() }}
        @include('admin.student.form', ['formAction' => 'Update'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#faculty').select2({
                placeholder: 'Select Faculty',
                allowClear: true,
            });
            var facultyId =  $('#faculty').val();
            var selectedSemester = @json($student->semester);
            getSemestersByFaculty(facultyId, selectedSemester);

            $('#faculty').change(function() {
                var facultyId = $(this).val();
                getSemestersByFaculty(facultyId);
            });
        });

        function getSemestersByFaculty(facultyId, defaultSelected = null) {
            var semesters = $('#semester').select2({
                placeholder: 'Select Semester',
                allowClear: true,
                ajax: {
                    url: "/admin/api/faculty/" + facultyId + '/semesters',
                    'dataType': 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (obj) {
                                return {
                                    id: obj.id,
                                    text: obj.name
                                };
                            })
                        }
                    }
                },
            }).val(defaultSelected).trigger('change');

            if (defaultSelected) {
                var option = new Option(defaultSelected.name, defaultSelected.id, true, true);
                semesters.append(option);
                semesters.trigger('change');
            }
        }
    </script>
@endpush
