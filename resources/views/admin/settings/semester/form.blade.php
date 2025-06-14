<div class="kt-portlet__body">
    <div class="form-group row validated">
        <div class="col-lg-6">
            {{ html()->label('Faculty') }}
            {{ html()->select('faculty_id', $faculties, $section->faculty_id ?? null)->class($errors->has('faculty_id') ? 'form-control is-invalid' : 'form-control')->id('faculty')  }}
            @error('faculty_id')
            <div id="" class="error invalid-feedback"> {{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <div class="row">
            <div class="col-lg-6">
                <a class="btn btn-primary" href="javascript:;"
                   onclick="confirmation()">
                    Update
                </a>


{{--                <button type="submit" class="btn btn-primary">{{ $formAction }}</button>--}}
                <a href="{{ route('admin.setting.index') }}" type="reset" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function confirmation() {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Do It!"
        }).then(function(result) {
            if (result.value) {
                document.getElementById('update-semester-form').submit();
                Swal.fire(
                    "Done!",
                    "Your action has been completed.",
                    "success"
                )
            }
        });
    };
</script>
