@extends('admin.layouts.master')
@section('title')
    Setting Edit
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Setting Edit
                </h3>
            </div>
        </div>
        {{ html()->modelForm($setting, 'put')->acceptsFiles()->route('admin.setting.update', $setting)->class('kt-form kt-form--label-right')->open() }}
        @include('admin.settings.form', ['formAction' => 'Update'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
