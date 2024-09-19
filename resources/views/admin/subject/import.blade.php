@extends('admin.layouts.master')
@section('title')
    Subject Import
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-primary">
                    Subject Import
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <a href="{{ route('admin.subject.export-sample') }}" class="btn btn-success btn-pill btn-sm">
                        <i class="la la-download"></i>
                        Export Sample
                    </a>
                </div>
            </div>
        </div>
        {{ html()->modelForm(null, 'post')->acceptsFiles()->route('admin.subject.store-import')->class('kt-form kt-form--label-right')->open() }}
        <div class="kt-portlet__body">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                        <div class="alert alert-danger alert-dismissible">
                            @foreach($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                        </div>
                    </div>
                </div>

            @endif

            <div class="form-group row validated">
                <div class="col-lg-6">
                    {{ html()->label('File') }}
                    {{ html()->file('file')->class($errors->has('file') ? 'form-control is-invalid' : 'form-control')->id('file')  }}
                    @error('file')
                    <div id="" class="error invalid-feedback"> {{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('admin.subject.index') }}" type="reset" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>

        {{ html()->closeModelForm() }}
    </div>
@endsection
