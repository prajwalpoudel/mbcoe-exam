<?php

namespace App\Exports\Sheets;

use App\Constants\FacultyConstant;
use App\Models\Faculty;
use App\Models\Semester;
use App\Models\Syllabus;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class SubjectImportSampleSheet implements FromCollection, WithHeadings, WithEvents, WithTitle, WithMapping
{
    protected $selects;
    protected $row_count;
    protected $fCount = 0;
    protected $sCount = 0;
    protected $syCount = 0;

    public function __construct()
    {
        $this->row_count = 100;
        $faculties = Faculty::pluck('name', 'id')->toArray();
        $this->fCount = count($faculties) ?? 0;
        $syllabus = Syllabus::pluck('name', 'id')->toArray();
        $this->syCount = count($syllabus) ?? 0;
        $semesters = Semester::groupBy('name')->orderBy('order')->pluck('name', 'id')->toArray();
        $this->sCount = count(Semester::all()) ?? 0;
        $selects = [  //selects should have column_name and options
            ['columns_name' => 'D', 'options' => $syllabus],
            ['columns_name' => 'F', 'options' => $faculties], //Column D has heading departments. See headings() method below
            ['columns_name' => 'H', 'options' => $semesters],
        ];

        $this->selects = $selects;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([
            []
        ]);
    }

    public function registerEvents(): array
    {
        return [
            // handle by a closure.
            AfterSheet::class => function (AfterSheet $event) {
                $row_count = $this->row_count;
                foreach ($this->selects as $select) {
                    $drop_column = $select['columns_name'];
                    $options = $select['options'];
                    // set dropdown list for first data row
                    $validation = $event->sheet->getCell("{$drop_column}2")->getDataValidation();
                    $validation->setType(DataValidation::TYPE_LIST);
                    $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $validation->setAllowBlank(false);
                    $validation->setShowInputMessage(true);
                    $validation->setShowErrorMessage(true);
                    $validation->setShowDropDown(true);
                    $validation->setErrorTitle('Input error');
                    $validation->setError('Value is not in list.');
                    $validation->setPromptTitle('Pick from list');
                    $validation->setPrompt('Please pick a value from the drop-down list.');
                    $validation->setFormula1(sprintf('"%s"', implode(',', $options)));
                    // clone validation to remaining rows
                    for ($i = 3; $i <= $row_count; $i++) {
                        $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                    }
                }
            },

        ];
    }

    public function headings(): array
    {
        return [
            'name',
            'code',
            'credit_hour',
            'syllabus',
            'syllabus_id',
            'faculty',
            'faculty_id',
            'semester',
            'semester_id',
            'is_elective'
        ];
    }

    public function map($row): array
    {
        return [
            '',
            '',
            '',
            'Old Syllabus',
            "=VLOOKUP(D2,syllabus!A$1:C{$this->syCount},2,FALSE)",
            FacultyConstant::CIVIL,
            "=VLOOKUP(F2,faculties!A$1:C{$this->fCount},2,FALSE)",
            'First',
            "=VLOOKUP((F2&"."\"-\""."&H2),semesters!A$1:C{$this->sCount},2,FALSE)",
            '0',
        ];
    }

    public function title(): string
    {
        return 'subjects';
    }
}
