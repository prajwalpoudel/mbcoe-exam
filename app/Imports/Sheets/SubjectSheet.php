<?php

namespace App\Imports\Sheets;

use App\Models\Subject;
use App\Services\SubjectService;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\PersistRelations;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SubjectSheet implements ToModel, PersistRelations, WithValidation, WithHeadingRow, WithChunkReading, WithCalculatedFormulas
{
//    /**
//     * @var SubjectService
//     */
//    private $subjectService;
//
//    /**
//     * SubjectSheet constructor.
//     * @param SubjectService $subjectService
//     */
//    public function __construct(SubjectService $subjectService)
//    {
//        $this->subjectService = $subjectService;
//    }

    public function model(array $row)
    {
        $subjects = [
            'name' => $row['name'],
            'code' => $row['code'],
            'credit_hour' => $row['credit_hour'],
            'syllabus_id' => $row['syllabus_id'],
            'faculty_id' => $row['faculty_id'],
            'semester_id' => $row['semester_id'],
            'is_elective' => $row['is_elective']
        ];

        Subject::updateOrCreate(
            Arr::only($subjects, ['syllabus_id', 'faculty_id', 'semester_id', 'name', 'code']),
            Arr::only($subjects, ['credit_hour', 'is_elective']),
        );
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'code' => 'required',
            'credit_hour' => 'required',
            'syllabus_id' => 'required',
            'faculty_id' => 'required',
            'semester_id' => 'required',
        ];
    }
}
