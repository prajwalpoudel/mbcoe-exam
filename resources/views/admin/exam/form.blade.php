<div class="kt-portlet__body">
    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Exam Type') }}
            {{ html()->select('exam_type_id', $examTypes, $exam->exam_type_id ?? null)->class($errors->has('exam_type_id') ? 'form-control is-invalid' : 'form-control')  }}
            @error('exam_type_id')
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
            {{ html()->label('Order') }}
            {{ html()->number('order')->class($errors->has('order') ? 'form-control is-invalid' : 'form-control') }}
            @error('order')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-lg-6">
            {{ html()->label('Start Date') }}
            {{ html()->date('start_date')->class($errors->has('start_date') ? 'form-control is-invalid' : 'form-control') }}
            @error('start_date')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('End Date') }}
            {{ html()->date('end_date')->class($errors->has('end_date') ? 'form-control is-invalid' : 'form-control') }}
            @error('end_date')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>

<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary">{{ $formAction }}</button>
                <a href="{{ route('admin.exam.index') }}" type="reset" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>
