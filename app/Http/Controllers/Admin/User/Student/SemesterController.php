<?php

namespace App\Http\Controllers\Admin\User\Student;

use App\Constants\StatusConstant;
use App\Http\Controllers\Controller;
use App\Services\SemesterService;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{
    /**
     * @var string
     */
    private $view = 'admin.student.details.semester.';
    /**
     * @var StudentService
     */
    private $studentService;
    /**
     * @var SemesterService
     */
    private $semesterService;

    /**
     * SemesterController constructor.
     * @param StudentService $studentService
     * @param SemesterService $semesterService
     */
    public function __construct(
        StudentService $studentService,
        SemesterService $semesterService
    ) {

        $this->studentService = $studentService;
        $this->semesterService = $semesterService;
    }

    public function index(string $id) {
        $student = $this->studentService->find($id);
        $student->load(['user', 'faculty', 'semesters' => function ($query) {
            return $query->orderBy('order', 'desc');
        }]);

        return view($this->view . 'index', compact('student'));
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function create(string $id) {
        $message = [
            'status' => 'success',
            'title' => 'Semester Created Successfully.'
        ];
        DB::beginTransaction();
        $student = $this->studentService->find($id)->load(['semesters' => function($query) {
            $query->where('status', StatusConstant::RUNNING)
                ->where('is_current', true);
        }]);
        $currentSemester = $student->semesters[0] ?? null;
        if($currentSemester) {
            $semester = $this->semesterService->where(['faculty_id' => $currentSemester->faculty_id, 'order' => $currentSemester->order+1])->first();
            $student->semesters()->updateExistingPivot($currentSemester, [
                'is_current' => false,
            ]);
            $student->semesters()->attach($semester, ['is_current' => true]);
        }
        else {
            $message['status'] = 'error';
            $message['title'] = 'Semester cannot be updated';
        }
        DB::commit();
        return redirect()->back()->with(
            [
                'message' => $message
            ]
        );
    }

    public function destroy(string $id) {
        $message = [
            'status' => 'success',
            'title' => 'Semester Deleted Successfully.'
        ];
        DB::beginTransaction();
        $student = $this->studentService->find($id)->load(['semesters' => function($query) {
            return $query->where('is_current', true);
        }]);
        $currentSemester = $student->semesters[0] ?? null;
        if($currentSemester && $currentSemester->order>1) {
            $semester = $this->semesterService->where(['faculty_id' => $currentSemester->faculty_id, 'order' => $currentSemester->order-1])->first();
            $student->semesters()->detach($currentSemester->id);
            $student->semesters()->updateExistingPivot($semester, [
                'is_current' => true,
            ]);
        }
        else {
            $message['status'] = 'error';
            $message['title'] = 'Semester cannot be deleted.';
        }
        DB::commit();
        return redirect()->back()->with(
            [
                'message' => $message
            ]
        );
    }
}
