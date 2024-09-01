<div class="kt-portlet__body">
    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Faculty') }}
            {{ html()->select('faculty_id', $faculties, $student->faculty_id ?? null)->class($errors->has('faculty_id') ? 'form-control is-invalid' : 'form-control')->id('faculty')  }}
            @error('faculty_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-lg-6">
            {{ html()->label('Semester') }}
            {{ html()->select('semester_id', [], $student->semester_id ?? null)->class($errors->has('semester_id') ? 'form-control is-invalid' : 'form-control')->id('semester')  }}
            @error('semester_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Batch') }}
            {{ html()->select('batch_id', $batches, $student->batch_id ?? null)->class($errors->has('batch_id') ? 'form-control is-invalid' : 'form-control')->id('batch')  }}
            @error('batch_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            {{ html()->label('Name') }}
            {{ html()->text('user[name]')->class($errors->has('user.name') ? 'form-control is-invalid' : 'form-control') }}
            @error('user.name')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Email') }}
            {{ html()->text('user[email]')->class($errors->has('user.email') ? 'form-control is-invalid' : 'form-control') }}
            @error('user.email')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            {{ html()->label('Phone') }}
            {{ html()->text('user[phone]')->class($errors->has('user.phone') ? 'form-control is-invalid' : 'form-control') }}
            @error('user.phone')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Address') }}
            {{ html()->text('user[address]')->class($errors->has('user.address') ? 'form-control is-invalid' : 'form-control') }}
            @error('user.address')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            {{ html()->label('Symbol Number') }}
            {{ html()->text('symbol_no')->class($errors->has('symbol_no') ? 'form-control is-invalid' : 'form-control') }}
            @error('symbol_no')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Registration Number') }}
            {{ html()->text('registration_number')->class($errors->has('registration_number') ? 'form-control is-invalid' : 'form-control') }}
            @error('registration_number')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            {{ html()->label('Admitted Year') }}
            {{ html()->date('admitted_year')->class($errors->has('admitted_year') ? 'form-control is-invalid' : 'form-control') }}
            @error('admitted_year')
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
                <a href="{{ route('admin.student.index') }}" type="reset" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>
