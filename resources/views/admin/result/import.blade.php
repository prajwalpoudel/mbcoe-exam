@extends('admin.layouts.master')
@section('title')
    Result Import
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Result Import
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <a href="{{ route('admin.result.export') }}" class="btn btn-success btn-pill btn-sm">
                        <i class="la la-download"></i>
                        Export Sample
                    </a>
                </div>
            </div>
        </div>
        {{ html()->modelForm(null, 'post')->acceptsFiles()->route('admin.result.store-import')->class('kt-form kt-form--label-right')->open() }}
        <div class="kt-portlet__body">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                        <div class="alert alert-danger alert-dismissible">
                            @foreach($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="form-group row validated">
                <div class="col-lg-6">
                    {{ html()->label('Exam') }}
                    {{ html()->select('exam_id', $exams, null)->class($errors->has('exam_id') ? 'form-control is-invalid' : 'form-control')->id('exam_id')  }}
                    @error('exam_id')
                    <div id="" class="error invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-6">
                    {{ html()->label('Syllabus') }}
                    {{ html()->select('syllabus_id', $syllabi, null)->class($errors->has('syllabus_id') ? 'form-control is-invalid' : 'form-control')->id('syllabus_id')  }}
                    @error('syllabus_id')
                    <div id="" class="error invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row validated">
                <div class="col-lg-6">
                    {{ html()->label('Faculty') }}
                    {{ html()->select('faculty_id', $faculties, null)->class($errors->has('faculty_id') ? 'form-control is-invalid' : 'form-control')->id('faculty')  }}
                    @error('faculty_id')
                    <div id="" class="error invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-6">
                    {{ html()->label('Semester') }}
                    {{ html()->select('semester_id', [], null)->class($errors->has('semester_id') ? 'form-control is-invalid' : 'form-control')->id('semester')  }}
                    @error('semester_id')
                    <div id="" class="error invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group row validated">
                <div class="col-lg-6">
                    {{ html()->label('File') }}
                    {{ html()->file('file')->class($errors->has('file') ? 'form-control is-invalid' : 'form-control')->id('file')  }}
                    @error('file')
                    <div id="" class="error invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary">
                            <i class="la la-upload"></i>Import</button>
                        <a href="{{ route('admin.result.index') }}" type="reset" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>

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
            }).val(2).trigger('change');

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
