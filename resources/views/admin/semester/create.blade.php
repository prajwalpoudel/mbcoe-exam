@extends('admin.layouts.master')
@section('title')
    Semester Create
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Semester Create
                </h3>
            </div>
        </div>
        {{ html()->modelForm(null, 'post')->route('admin.semester.store')->class('kt-form kt-form--label-right')->open() }}
            @include('admin.semester.form', ['formAction' => 'Save'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
