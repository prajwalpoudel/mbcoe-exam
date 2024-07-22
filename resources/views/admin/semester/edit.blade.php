@extends('admin.layouts.master')
@section('title')
    Semester Edit
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Semester Edit
                </h3>
            </div>
        </div>
        {{ html()->modelForm($semester, 'put')->route('admin.semester.update', $semester)->class('kt-form kt-form--label-right')->open() }}
        @include('admin.semester.form', ['formAction' => 'Update'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
