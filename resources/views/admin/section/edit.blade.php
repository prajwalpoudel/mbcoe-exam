@extends('admin.layouts.master')
@section('title')
    Section Edit
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Section Edit
                </h3>
            </div>
        </div>
        {{ html()->modelForm($Section, 'put')->route('admin.section.update', $section)->class('kt-form kt-form--label-right')->open() }}
        @include('admin.section.form', ['formAction' => 'Update'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
