@extends('admin.layouts.master')
@section('title')
    Syllabus Create
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Syllabus Create
                </h3>
            </div>
        </div>
        {{ html()->modelForm(null, 'post')->route('admin.syllabus.store')->class('kt-form kt-form--label-right')->open() }}
            @include('admin.syllabus.form', ['formAction' => 'Save'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
