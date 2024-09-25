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
            {{ html()->label('Email') }}
            {{ html()->text('email')->class($errors->has('email') ? 'form-control is-invalid' : 'form-control') }}
            @error('email')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Address') }}
            {{ html()->text('address')->class($errors->has('address') ? 'form-control is-invalid' : 'form-control') }}
            @error('address')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-lg-6">
            {{ html()->label('Phone') }}
            {{ html()->text('phone')->class($errors->has('phone') ? 'form-control is-invalid' : 'form-control') }}
            @error('phone')
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
                <a href="{{ route('admin.profile.index') }}" type="reset" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>
