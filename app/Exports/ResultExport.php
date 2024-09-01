<?php

namespace App\Exports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResultExport implements FromCollection, WithHeadings
{
    private $data;

    /**
     * ResultExport constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect();
    }

    public function headings(): array
    {
        $subjects = Subject::where('syllabus_id', $this->data['syllabus_id'])->where('semester_id', $this->data['semester_id'])->pluck('name');
        $headings = [
            'symbol_no'
        ];
        foreach ($subjects as $subject) {
            array_push($headings, $subject);
        }

        return $headings;
    }
}
