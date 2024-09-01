@extends('admin.student.show')
@section('detail')
    <div class="col-xl-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Basic Information</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                </div>
            </div>
            <form class="kt-form kt-form--label-right">
                <div class="kt-portlet__body">
                    <div class="kt-section kt-section--first">
                        <div class="kt-section__body">
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3">Symbol No</label>
                                <div class="col-lg-9 col-xl-6">
                                    <label>{{ $student->symbol_no }}</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3">Registration No</label>
                                <div class="col-lg-9 col-xl-6">
                                    <label>{{ $student->registration_number }}</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3">Batch</label>
                                <div class="col-lg-9 col-xl-6">
                                    <label>{{ $student->batch->name ?? "N/R" }}</label>
                                </div>
                            </div>

                            <div class="form-group form-group-last row">
                                <label class="col-xl-3 col-lg-3">Admitted Year</label>
                                <div class="col-lg-9 col-xl-6">
                                    <label>{{ $student->admitted_year ?? "N/R" }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-5">
                            </div>
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-primary ">Back</button>&nbsp;
                                <button type="button" class="btn btn-success ">Semesters</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
