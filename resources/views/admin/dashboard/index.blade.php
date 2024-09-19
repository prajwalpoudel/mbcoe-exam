@extends('admin.layouts.master')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Dashboard</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <h3>Welcome to MBCOE Exam Result.</h3>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Batches</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget20">
                        <div class="kt-widget20__content kt-portlet__space-x">
                            <span class="kt-widget20__number kt-font-brand">{{ $batchCount }} + </span>
                            <span class="kt-widget20__desc">Total batches</span>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-4">
                            </div>
                            <div class="col-lg-4">
                                <a href="{{ route('admin.batch.index') }}"  type="button" class="btn btn-success ">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Faculties</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget20">
                        <div class="kt-widget20__content kt-portlet__space-x">
                            <span class="kt-widget20__number kt-font-danger">{{ $facultyCount }} +</span>
                            <span class="kt-widget20__desc">Total faculties</span>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-4">
                            </div>
                            <div class="col-lg-4">
                                <a href="{{ route('admin.faculty.index') }}"  type="button" class="btn btn-primary ">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Subjects</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget20">
                        <div class="kt-widget20__content kt-portlet__space-x">
                            <span class="kt-widget20__number kt-font-success">{{ $subjectCount }} +</span>
                            <span class="kt-widget20__desc">Total Subjects</span>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-4">
                            </div>
                            <div class="col-lg-4">
                                <a href="{{ route('admin.subject.index') }}"  type="button" class="btn btn-danger ">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Students</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget20">
                        <div class="kt-widget20__content kt-portlet__space-x">
                            <span class="kt-widget20__number kt-font-primary">{{ $studentCount }} +</span>
                            <span class="kt-widget20__desc">Total Students</span>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-4">
                            </div>
                            <div class="col-lg-4">
                                <a href="{{ route('admin.student.index') }}"  type="button" class="btn btn-secondary ">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


