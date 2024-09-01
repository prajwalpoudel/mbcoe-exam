<div class="kt-portlet__body">
    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Faculty') }}
            {{ html()->select('faculty_id', $faculties, $section->faculty_id ?? null)->class($errors->has('faculty_id') ? 'form-control is-invalid' : 'form-control')->id('faculty')  }}
            @error('faculty_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-lg-6">
            {{ html()->label('Semester') }}
            {{ html()->select('semester_id', [], $semester->semester_id ?? null)->class($errors->has('semester_id') ? 'form-control is-invalid' : 'form-control')->id('semester')  }}
            @error('semester_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Name') }}
            {{ html()->text('name')->class($errors->has('name') ? 'form-control is-invalid' : 'form-control') }}
            @error('name')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary">{{ $formAction }}</button>
                <a href="{{ route('admin.section.index') }}" type="reset" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>
