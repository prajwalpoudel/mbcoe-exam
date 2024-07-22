@extends('admin.layouts.master')
@section('title')
    Batch Edit
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Batch Edit
                </h3>
            </div>
        </div>
        {{ html()->modelForm($batch, 'put')->route('admin.batch.update', $batch)->class('kt-form kt-form--label-right')->open() }}
        @include('admin.batch.form', ['formAction' => 'Update'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
