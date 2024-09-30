<div class="kt-portlet__body">
    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Faculty') }}
            {{ html()->select('faculty_id', $faculties, $semester->faculty_id ?? null)->class($errors->has('faculty_id') ? 'form-control is-invalid' : 'form-control')  }}
            @error('faculty_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            {{ html()->label('Name') }}
            {{ html()->text('name')->class($errors->has('name') ? 'form-control is-invalid' : 'form-control') }}
            @error('name')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Display Name') }}
            {{ html()->text('display_name')->class($errors->has('display_name') ? 'form-control is-invalid' : 'form-control') }}
            @error('display_name')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            {{ html()->label('Code') }}
            {{ html()->text('code')->class($errors->has('code') ? 'form-control is-invalid' : 'form-control') }}
            @error('code')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Order') }}
            {{ html()->text('order')->class($errors->has('order') ? 'form-control is-invalid' : 'form-control') }}
            @error('order')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
        <div class="col-lg-6">
            {{ html()->label('Number of Elective Subject') }}
            {{ html()->number('no_of_elective', $semester ?? 0)->class($errors->has('no_of_elective') ? 'form-control is-invalid' : 'form-control') }}
            @error('no_of_elective')
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
                <a href="{{ route('admin.semester.index') }}" type="reset" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>
