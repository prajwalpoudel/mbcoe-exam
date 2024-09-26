@extends('admin.layouts.master')
@section('title')
    Profile
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Profile
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <a href="{{ route('admin.profile.edit', $user->id) }}" class="btn btn-success btn-pill btn-sm">
                        Edit
                    </a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <h6>Name : {{ $user->name }}</h6>
            <h6>Email : {{ $user->email }}</h6>
            <h6>Address : {{ $user->address }}</h6>
            <h6>Phone : {{ $user->phone }}</h6>
        </div>
    </div>
@endsection

