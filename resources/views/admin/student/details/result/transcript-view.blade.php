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
