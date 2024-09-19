<?php

namespace App\Imports;

use App\Exports\Sheets\BatchSheet;
use App\Imports\Sheets\FacultySheet;
use App\Imports\Sheets\SemesterSheet;
use App\Imports\Sheets\StudentDetailSheet;
use App\Imports\Sheets\SubjectSheet;
use App\Imports\Sheets\SyllabusSheet;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SubjectImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'subjects' => new SubjectSheet,
            'syllabus' => new SyllabusSheet(),
            'faculties' => new FacultySheet(),
            'semesters' => new SemesterSheet()
        ];
    }
}
