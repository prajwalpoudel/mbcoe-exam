@extends('admin.layouts.master')
@section('title')
    Syllabus Edit
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Syllabus Edit
                </h3>
            </div>
        </div>
        {{ html()->modelForm($syllabus, 'put')->route('admin.syllabus.update', $syllabus)->class('kt-form kt-form--label-right')->open() }}
        @include('admin.syllabus.form', ['formAction' => 'Update'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
