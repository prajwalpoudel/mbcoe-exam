<div class="kt-portlet__body">
    <div class="form-group row validated">
    {{ html()->input('hidden', 'student_id', $student->id ?? null)->class($errors->has('student_id') ? 'form-control is-invalid' : 'form-control')->id('student')  }}
    <div class="col-lg-6">
        {{ html()->label('Faculty') }}
        {{ html()->select('faculty_id', $faculties, $student->faculty_id ?? null)->class($errors->has('faculty_id') ? 'form-control is-invalid' : 'form-control')->id('faculty')->disabled(true)  }}
        @error('faculty_id')
        <div id="" class="error invalid-feedback"> {{ $message }}</div>
        @enderror
    </div>

    <div class="col-lg-6">
        {{ html()->label('Syllabus') }}
        {{ html()->select('syllabus_id', $syllabi, $student->batch->syllabus_id ?? null)->class($errors->has('syllabus_id') ? 'form-control is-invalid' : 'form-control')->id('syllabus')->disabled(true)  }}
        @error('syllabus_id')
        <div id="" class="error invalid-feedback"> {{ $message }}</div>
        @enderror
    </div>
</div>
    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Semester') }}
            {{ html()->select('semester_id', [], null)->class($errors->has('semester_id') ? 'form-control is-invalid' : 'form-control')->id('semester')  }}
            @error('semester_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-lg-6">
            {{ html()->label('Subject') }}
            {{ html()->select('subject_id', [], null)->class($errors->has('semester_id') ? 'form-control is-invalid' : 'form-control')->id('subject')  }}
            @error('subject_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Exam') }}
            {{ html()->select('exam_id', $exams, null)->class($errors->has('exam_id') ? 'form-control is-invalid' : 'form-control')->id('exam')  }}
            @error('exam_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            {{ html()->label('Grade') }}
            {{ html()->select('grade', $grades, null)->class($errors->has('grade_id') ? 'form-control is-invalid' : 'form-control')->id('grade')  }}
            @error('grade')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row validated">
        <div class="col-lg-12">
            {{ html()->label('Remarks') }}
            {{ html()->textarea('remarks', null)->class($errors->has('remark') ? 'form-control is-invalid' : 'form-control')->id('remarks')  }}
            @error('remarks')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <div class="row">
            <div class="col-lg-5">
            </div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary">{{ $formAction }}</button>
                <a href="{{ route('admin.student.show', $student->id) }}"  type="button" class="btn btn-secondary ">Cancel</a>
            </div>
        </div>
    </div>
</div>
