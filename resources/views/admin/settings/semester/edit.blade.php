@extends('admin.layouts.master')
@section('title')
    Semester Update
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Update Semester for:
                </h3>
            </div>
        </div>
        {{ html()->modelForm(null, 'put')->route('admin.setting.semester')->id('update-semester-form')->class('kt-form kt-form--label-right')->open() }}
        @include('admin.settings.semester.form', ['formAction' => 'Update'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
