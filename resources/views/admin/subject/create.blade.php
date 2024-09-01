@extends('admin.layouts.master')
@section('title')
    Subject Create
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Subject Create
                </h3>
            </div>
        </div>
        {{ html()->modelForm(null, 'post')->route('admin.subject.store')->class('kt-form kt-form--label-right')->open() }}
            @include('admin.subject.form', ['formAction' => 'Save'])
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
            $('#syllabus').select2({
                placeholder: 'Select Syllabus',
                allowClear: true,
            });
            var facultyId =  $('#faculty').val();
            getSemestersByFaculty(facultyId);

            $('#faculty').change(function() {
                var facultyId = $(this).val();
                getSemestersByFaculty(facultyId);
            });
            $('#semester').select2({
                placeholder: 'Select Semester',
                allowClear: true,
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
                _.each(defaultSelected, function (data) {
                    var option = new Option(data.text, data.id, true, true);
                    semesters.append(option);
                })
                semesters.trigger('change');
            }
        }
    </script>
@endpush
