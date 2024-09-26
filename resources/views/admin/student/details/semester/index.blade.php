@extends('admin.student.show')
@section('detail')
    <div class="col-xl-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Semesters</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <a href="#" class="btn btn-success btn-pill btn-sm">
                        Create
                    </a>
                </div>
            </div>
            <div class="kt-portlet__body">
                <table class="table table-bordered table-striped table-responsive">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Code</th>
                        <th>Is Current</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($student->semesters as $semester)
                        <tr>
                            <td>{{ $semester->name }}</td>
                            <td>{{ $semester->display_name }}</td>
                            <td>{{ $semester->code }}</td>
                            <td>
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                    <label>
                                        <input type="checkbox" disabled {{ $semester->pivot->is_current ? "checked" : "" }}>
                                        <span></span>
                                    </label>
                                </span>
                            </td>
                            <td>
                                <a class="btn btn-danger btn-sm blue btn-outline mr-1 pr-2" href="javascript:;"
                                   onclick="">
                                    <i class="la la-trash"></i>
{{--                                    {{ html()->form('delete')->route($params['route'].'.destroy',$params['id'])->id('delete-'.$params['id'])->open() }}--}}

{{--                                    {{ html()->form()->close() }}--}}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-5">
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ url()->previous() }}"  type="button" class="btn btn-primary ">Back</a>&nbsp;
                            <a href="{{ route('admin.student.result', $student->id) }}"  type="button" class="btn btn-success ">Result</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
