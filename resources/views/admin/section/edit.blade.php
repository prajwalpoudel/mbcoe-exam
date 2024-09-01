@extends('admin.layouts.master')
@section('title')
    Section Edit
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Section Edit
                </h3>
            </div>
        </div>
        {{ html()->modelForm($section, 'put')->route('admin.section.update', $section)->class('kt-form kt-form--label-right')->open() }}
        @include('admin.section.form', ['formAction' => 'Update'])
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
            var selectedSemester = @json($section->semester);
            getSectionsByFaculty(facultyId, selectedSemester);

            $('#faculty').change(function() {
                var facultyId = $(this).val();
                getSectionsByFaculty(facultyId);
            });
        });

        function getSectionsByFaculty(facultyId, defaultSelected = null) {
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
