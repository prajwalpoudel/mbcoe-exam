@extends('admin.student.show')
@section('detail')
    <div class="col-xl-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Result</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <a href="{{ route('admin.student.transcript', $student->id) }}" target="_blank" class="btn btn-success btn-pill btn-sm">
                        Generate Transcript
                    </a>
                </div>
            </div>
            <div class="kt-portlet__body">
                @foreach($data as $semester => $dat)
                    <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                {{ $semester }} Semester
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Subjects</th>
                                @foreach($exams as $exam)
                                    @if($exam->semester == $semester)
                                        <th>{{ $exam->exam. ' '. $exam->examType }}</th>
                                    @endif
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dat as $subject=>$d)
                                <tr>
                                    <td>{{$subject}}</td>
                                    @foreach($d as $eYear=>$grade)
                                        <td>{{$grade}}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-5">
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ url()->previous() }}"  type="button" class="btn btn-primary ">Back</a>&nbsp;
                            <a href="{{ route('admin.student.show', $student->id) }}"  type="button" class="btn btn-success ">Basic Info</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
