<?php

namespace App\Imports;

use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use function PHPUnit\Framework\isNull;

class ResultImport implements ToModel, WithHeadingRow, WithValidation
{
    private $data;

    /**
     * ResultImport constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function model(array $row)
    {
        $student = Student::where('symbol_no', $row['symbol_no'])->first();
        $subjects = Subject::where('syllabus_id', $this->data['syllabus_id'])
            ->where('faculty_id', $this->data['faculty_id'])
            ->where('semester_id', $this->data['semester_id'])->get();
        foreach ($subjects as $subject) {
            if(array_key_exists(getStrAsRow($subject->name), $row) && isset($student)) {
                $resultData = [
                    'grade' => $row[getStrAsRow($subject->name)],
                    'student_id' => $student->id,
                    'exam_id' => $this->data['exam_id'],
                    'subject_id' => $subject->id,
                ];
                $student->results()->create($resultData);
            }
        }
    }

    public function rules(): array
    {
        return [
//            'faculty_id' => 'required'
        ];
    }
}
