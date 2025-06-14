@extends('admin.student.show')
@section('detail')
    <div class="col-xl-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Semesters</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <a href="{{ route('admin.student.semester.create', $student->id) }}" class="btn btn-success btn-pill btn-sm">
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
                                @if($student->semesters->count() > 1 && $semester->pivot->is_current == 1)
                                    <a class="btn btn-danger btn-sm blue btn-outline mr-1 pr-2" href="javascript:;"
                                   onclick="confirmation('delete-semester-form')">
                                    <i class="la la-trash"></i>
                                    {{ html()->form('delete')->route('admin.student.semester.destroy', $semester->pivot->student_id)->id('delete-semester-form')->open() }}

                                    {{ html()->form()->close() }}
                                </a>
                                @else
                                    <a class="btn btn-danger btn-sm blue btn-outline mr-1 pr-2 anchor-disabled" href="javascript:;">
                                        <i class="la la-trash"></i>
                                    </a>
                                @endif
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
@push('style')
    <style>
        .anchor-disabled {
            opacity: .4;
            cursor: default !important;
            pointer-events: none;
        }
    </style>
@endpush
@push('script')
    <script>
        function confirmation(formId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Do It!"
            }).then(function(result) {
                if (result.value) {
                    document.getElementById(formId).submit();
                    Swal.fire(
                        "Done!",
                        "Your action has been completed.",
                        "success"
                    )
                }
            });
        };
    </script>
@endpush
