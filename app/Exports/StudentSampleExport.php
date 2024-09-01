<?php

namespace App\Exports;

use App\Exports\Sheets\BatchSheet;
use App\Exports\Sheets\FacultySheet;
use App\Exports\Sheets\SemesterSheet;
use App\Exports\Sheets\StudentImportSampleSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class StudentSampleExport implements WithMultipleSheets
{

    public function sheets(): array
    {
        $sheets [] = new StudentImportSampleSheet();
        $sheets [] = new BatchSheet();
        $sheets [] = new FacultySheet();
        $sheets [] = new SemesterSheet();
        return $sheets;
    }
}
