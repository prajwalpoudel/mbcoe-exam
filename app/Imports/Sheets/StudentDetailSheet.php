<?php


namespace App\Imports\Sheets;


use App\Models\Semester;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\HasReferencesToOtherSheets;
use Maatwebsite\Excel\Concerns\PersistRelations;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentDetailSheet implements ToModel, PersistRelations, WithValidation, WithHeadingRow, WithCalculatedFormulas
{
    use RemembersRowNumber;
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        $student = Student::where('symbol_no', $row['symbol_no'])->first();
        $semester = Semester::find($row['semester_id']);
        $semesters = Semester::where(
            'faculty_id', $row['faculty_id']
        )->where('order', '<', $semester->order)->pluck('id');
        $userData = [
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => bcrypt('password'),
            'address' => $row['address'],
            'phone' => $row['phone'],
            'role_id' => 2
        ];
        $studentData = [
            'symbol_no' => $row['symbol_no'],
            'registration_number' => $row['registration_number'],
            'admitted_year' => Carbon::createFromFormat('Y', $row['admitted_year']),
            'batch_id' => $row['batch_id'],
            'faculty_id' => $row['faculty_id']
        ];
        foreach($semesters as $sem) {
            $semestersData[$sem] = ['is_current' => false];
        }
        $semestersData[$semester->id] = ['is_current' => true];
        DB::connection()->disableQueryLog();
        DB::beginTransaction();
        if($student) {
            $student->update($studentData);
            $student->user()->update($userData);
            $student->semesters()->sync($semestersData);
        }
        else {
            $user = User::create($userData);
            $student = $user->student()->create($studentData);
            $student->semesters()->sync($semestersData);
        }
        DB::commit();
        DB::connection()->enableQueryLog();
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'symbol_no' => 'required',
            'registration_number' => 'required',
            'batch_id' => 'required',
            'admitted_year' => 'required',
            'faculty_id' => 'required',
            'semester_id' => 'required',
        ];
    }
}
