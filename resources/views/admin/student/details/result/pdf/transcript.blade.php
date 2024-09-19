<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Result</title>
    <style>
        body {
            line-height: 1 !important;
        }

        .title {
            text-align: center;
            line-height: 0.4;
        }

        .student-details {
            line-height: 0.4;
        }

        .student-details .col1 {
            position: absolute;
            top: 60px;
            left: 0px;
        }

        .student-details .col2 {
            position: absolute;
            top: 60px;
            right: 0px;
        }

        .document-name {
            margin-top: 30px;
            text-decoration: underline;
            text-align: center;
        }
        .transcript-table {
            border-collapse: collapse;
            width: 100%;
        }
        .transcript-table td, .transcript-table th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .transcript-table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
        .transcript-table tr:nth-child(even)
        {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="title">
    <h3>Madan Bhandari Memorial Academy Nepal</h3>
    <h4>Urlabari-03, Morang</h4>
</div>

<div class="student-details">
    <div class="col1">
        <h3>Name: {{ $student->user->name }}</h3>
        <h3>Faculty: {{ $student->faculty->name }}</h3>
    </div>
    <div class="col2">
        <h3>Symbol No : {{ $student->symbol_no }}</h3>
        <h3>Batch: {{ $student->batch->name }}</h3>
    </div>
</div>
<div class="document-name">
    <h3>Academic Transcript</h3>
</div>

@foreach($data as $semester => $dat)
    <h3>{{ $semester." Semester"}}</h3>
    <table class="transcript-table">
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
@endforeach
</body>
</html>
