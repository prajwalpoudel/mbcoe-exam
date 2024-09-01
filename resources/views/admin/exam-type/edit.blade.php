@extends('admin.layouts.master')
@section('title')
    Exam Type Edit
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Exam Type Edit
                </h3>
            </div>
        </div>
        {{ html()->modelForm($examType, 'put')->route('admin.exam-type.update', $examType)->class('kt-form kt-form--label-right')->open() }}
        @include('admin.exam-type.form', ['formAction' => 'Update'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
