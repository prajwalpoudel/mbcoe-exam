<?php


namespace App\Exports\Sheets;


use App\Constants\FacultyConstant;
use App\Models\Batch;
use App\Models\Faculty;
use App\Models\Semester;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\VLookup;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class StudentImportSampleSheet implements FromCollection, WithHeadings, WithEvents, WithTitle, WithMapping
{
    protected $selects;
    protected $row_count;
    protected $bCount = 0;
    protected $fCount = 0;
    protected $sCount = 0;


    public function __construct()
    {
        $this->row_count = 10;
        $batches = Batch::pluck('name', 'id')->toArray();
        $this->bCount = count($batches) ?? 0;
        $faculties = Faculty::pluck('name', 'id')->toArray();
        $this->fCount = count($faculties) ?? 0;
        $semesters = Semester::distinct('name')->pluck('name', 'id')->toArray();
        $this->sCount = count($semesters) ?? 0;
        $selects = [  //selects should have column_name and options
            ['columns_name' => 'H', 'options' => $batches],
            ['columns_name' => 'J', 'options' => $faculties], //Column D has heading departments. See headings() method below
            ['columns_name' => 'L', 'options' => $semesters],
        ];

        $this->selects = $selects;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $student = Student::first();

        return collect([
            []
        ]);
    }

    public function headings(): array
    {
        return [
            'name',
            'email',
            'address',
            'phone',
            'symbol_no',
            'registration_number',
            'admitted_year',
            'batch',
            'batch_id',
            'faculty',
            'faculty_id',
            'semester',
            'semester_id',
        ];
    }


    /**
     * @return \Closure[]
     */
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

    public function title(): string
    {
        return 'students';
    }

    public function map($row): array
    {
        return [
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '2075',
            "=VLOOKUP(H2,batches!A$1:C{$this->bCount},2,FALSE)",
            FacultyConstant::CIVIL,
            "=VLOOKUP(J2,faculties!A$1:C{$this->fCount},2,FALSE)",
            'First',
            "=VLOOKUP((J2&"."\"-\""."&L2),semesters!A$1:C$16,2,FALSE)",
        ];
    }
}
