@extends('admin.layouts.master')
@section('title')
    Settings
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Settings
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <a href="{{ route('admin.setting.edit', $setting->id) }}" class="btn btn-success btn-pill btn-sm">
                        Edit
                    </a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <h6>Name : {{ $setting->name }}</h6>
            <h6>Website Name : {{ $setting->site_name }}</h6>
            <h6>Address : {{ $setting->address }}</h6>
            <h6>Phone : {{ $setting->phone }}</h6>
            <h6>Logo : </h6><img src="{{ getImageUrl($setting->logo)}}" alt="MBMAN LOGO" height="150" width="150">
        </div>
    </div>
@endsection

