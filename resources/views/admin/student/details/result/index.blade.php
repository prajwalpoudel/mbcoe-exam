@extends('admin.student.show')
@section('detail')
    <div class="col-xl-12">
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Result</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <a href="#" class="btn btn-success btn-pill btn-sm">
                        Create
                    </a>
                </div>
            </div>
            <div class="kt-portlet__body">
                @foreach($results as $key=>$result)
                    <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                {{ $key }} Semester
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    @foreach($semesterExamsData as $semesterKey => $semesterData)
                                        @if($key == $semesterKey)
                                            @foreach($semesterData as $data)
                                            <th> {{ $data['exam'].' '.$data['examType'] }}</th>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($result as  $subject => $subjectResult)
                                    <tr>
                                        <td>{{ $subject }}</td>
                                        @foreach($subjectResult as  $sr)
                                            <th>{{ $sr }}</th>
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
                            <button type="button" class="btn btn-primary ">Back</button>&nbsp;
                            <button type="button" class="btn btn-success ">Basic Info</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
