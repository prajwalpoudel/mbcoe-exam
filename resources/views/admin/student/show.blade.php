@extends('admin.layouts.master')
@section('title')
    Student Details
@endsection

@section('content')
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
        @include('admin.student.details.aside')
        <!--Begin:: App Content-->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
            <div class="row">
                @yield('detail')
            </div>
        </div>

        <!--End:: App Content-->
    </div>
@endsection

