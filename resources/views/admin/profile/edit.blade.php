@extends('admin.layouts.master')
@section('title')
    Profile Edit
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Profile Edit
                </h3>
            </div>
        </div>
        {{ html()->modelForm($user, 'put')->route('admin.profile.update', $user->id)->class('kt-form kt-form--label-right')->open() }}
        @include('admin.profile.form', ['formAction' => 'Update'])
        {{ html()->closeModelForm() }}
    </div>
@endsection
