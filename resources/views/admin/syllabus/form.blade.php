<div class="kt-portlet__body">
    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Name') }}
            {{ html()->text('name')->class($errors->has('name') ? 'form-control is-invalid' : 'form-control') }}
            @error('name')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-lg-6">
            {{ html()->label('Updated On') }}
            {{ html()->date('updated_on')->class($errors->has('updated_on') ? 'form-control is-invalid' : 'form-control')  }}
            @error('updated_on')
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
                <a href="{{ route('admin.syllabus.index') }}" type="reset" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>
