<?php

namespace App\Http\Controllers\Admin\User\Student;

use App\Constants\RoleConstant;
use App\Exports\StudentSampleExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudentRequest;
use App\Imports\UsersImport;
use App\Services\BatchService;
use App\Services\FacultyService;
use App\Services\SemesterService;
use App\Services\StudentService;
use App\Services\UserService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * @var string
     */
    private $view = 'admin.student.';
    /**
     * @var StudentService
     */
    private $studentService;
    /**
     * @var FacultyService
     */
    private $facultyService;
    /**
     * @var BatchService
     */
    private $batchService;
    /**
     * @var SemesterService
     */
    private $semesterService;
    /**
     * @var UserService
     */
    private $userService;

    /**
     * StudentController constructor.
     * @param StudentService $studentService
     * @param FacultyService $facultyService
     * @param BatchService $batchService
     * @param SemesterService $semesterService
     * @param UserService $userService
     */
    public function __construct(
        StudentService $studentService,
        FacultyService $facultyService,
        BatchService $batchService,
        SemesterService $semesterService,
        UserService $userService
    )
    {
        $this->studentService = $studentService;
        $this->facultyService = $facultyService;
        $this->batchService = $batchService;
        $this->semesterService = $semesterService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->studentService->datatable($request);
        }
        $faculties = $this->facultyService->all()->pluck('name', 'id');
        $faculties->prepend('All', null);
        $semesters = $this->semesterService->query()->groupBy('name')->orderBy('id')->pluck('name', 'name');
        $semesters->prepend('All', null);

        return view($this->view . 'index', compact('faculties', 'semesters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = $this->facultyService->allForDropDown();
        $batches = $this->batchService->allForDropDown();

        return view($this->view . 'create', compact('faculties', 'batches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $userData = $request->input('user');
        $userData['role_id'] = RoleConstant::STUDENT_ID;
        $studentData = $request->except('user');
        $semester = $this->semesterService->find($request->input('semester_id'));
        $semesters = $this->semesterService->query()
            ->where('faculty_id', $request->input('faculty_id'))
            ->where('order', '<', $semester->order)->pluck('id');
        foreach ($semesters as $sem) {
            $semestersData[$sem] = ['is_current' => false];
        }
        $semestersData[$semester->id] = ['is_current' => true];
        $user = $this->userService->create($userData);
        $student = $user->student()->create($studentData);
        $student->semesters()->sync($semestersData);

        return $this->studentService->redirect('admin.student.index', 'success', 'Student created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = $this->studentService->find($id)->load(['user', 'faculty']);

        return view($this->view . 'details.basic', compact('student'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = $this->studentService->find($id);
        $faculties = $this->facultyService->allForDropDown();
        $batches = $this->batchService->allForDropDown();

        return view($this->view . 'edit', compact('student', 'faculties', 'batches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        $student = $this->studentService->find($id);
        $userData = $request->input('user');
        $studentData = $request->except('user');
        $semester = $this->semesterService->find($request->input('semester_id'));
        $semesters = $this->semesterService->query()
            ->where('faculty_id', $request->input('faculty_id'))
            ->where('order', '<', $semester->order)->pluck('id');
        foreach ($semesters as $sem) {
            $semestersData[$sem] = ['is_current' => false];
        }
        $semestersData[$semester->id] = ['is_current' => true];

        $student->update($studentData);
        $student->user()->update($userData);
        $student->semesters()->sync($semestersData);

        return $this->studentService->redirect('admin.student.index', 'success', 'Student created successfully');
    }

    /**
     * @return Container|mixed|object
     */
    public function import()
    {
        return view($this->view . 'import');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function storeImport(Request $request)
    {
        $file = $request->file('file');
        set_time_limit(300);
        Excel::import(new UsersImport, $file);

        return $this->studentService->redirect('admin.student.index', 'success', 'Student imported successfully');
    }

    public function exportSample()
    {
        return Excel::download(new StudentSampleExport, 'student.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = $this->studentService->find($id);
        $student->user()->delete();
        $student->semesters()->delete();
        $student->delete();

        return $this->studentService->redirect('admin.student.index', 'success', 'Student deleted successfully.');
    }

    public function getStudentsByFaculty($facultyId)
    {
        $students = $this->studentService->query()->where('faculty_id', $facultyId)->with(['user'])->get();
        return response()->json($students);
    }
}
