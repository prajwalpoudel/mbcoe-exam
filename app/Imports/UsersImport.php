<?php

namespace App\Imports;

use App\Exports\Sheets\BatchSheet;
use App\Imports\Sheets\FacultySheet;
use App\Imports\Sheets\SemesterSheet;
use App\Imports\Sheets\StudentDetailSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class UsersImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'students' => new StudentDetailSheet(),
            'faculties' => new FacultySheet(),
            'batches' => new BatchSheet(),
            'semesters' => new SemesterSheet()
        ];
    }
}
