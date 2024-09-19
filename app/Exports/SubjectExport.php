<?php

namespace App\Exports;

use App\Exports\Sheets\FacultySheet;
use App\Exports\Sheets\SemesterSheet;
use App\Exports\Sheets\SubjectImportSampleSheet;
use App\Exports\Sheets\SyllabusSheet;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SubjectExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets [] = new SubjectImportSampleSheet();
        $sheets [] = new SyllabusSheet();
        $sheets [] = new FacultySheet();
        $sheets [] = new SemesterSheet();
        return $sheets;
    }
}
