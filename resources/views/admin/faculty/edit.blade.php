@extends('admin.layouts.master')
@section('title')
    Faculty Edit
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Faculty Edit
                </h3>
            </div>
        </div>
        {{ html()->modelForm($faculty, 'put')->route('admin.faculty.update', $faculty)->class('kt-form kt-form--label-right')->open() }}
        @include('admin.faculty.form', ['formAction' => 'Update'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
