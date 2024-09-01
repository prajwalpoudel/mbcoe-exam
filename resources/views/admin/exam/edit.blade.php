@extends('admin.layouts.master')
@section('title')
    Exam Edit
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Exam Edit
                </h3>
            </div>
        </div>
        {{ html()->modelForm($exam, 'put')->route('admin.exam.update', $exam)->class('kt-form kt-form--label-right')->open() }}
        @include('admin.exam.form', ['formAction' => 'Update'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
