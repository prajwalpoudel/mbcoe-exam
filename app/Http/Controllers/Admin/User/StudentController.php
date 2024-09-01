<?php

namespace App\Http\Controllers\Admin\User;

use App\Exports\StudentSampleExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudentRequest;
use App\Imports\UsersImport;
use App\Services\BatchService;
use App\Services\FacultyService;
use App\Services\StudentService;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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
     * StudentController constructor.
     * @param StudentService $studentService
     * @param FacultyService $facultyService
     * @param BatchService $batchService
     */
    public function __construct(
        StudentService $studentService,
        FacultyService $facultyService,
        BatchService $batchService
    )
    {
        $this->studentService = $studentService;
        $this->facultyService = $facultyService;
        $this->batchService = $batchService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->studentService->datatable($request);
        }
        return view($this->view . 'index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = $this->facultyService->allForDropDown();
        $batches = $this->batchService->allForDropDown();

        return view($this->view.'create', compact('faculties', 'batches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        dd($request->all());
        $this->studentService->create($request->all());

        return $this->studentService->redirect('admin.student.index', 'success', 'Student created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = $this->studentService->find($id)->load(['user', 'faculty']);

        return view($this->view.'details.basic', compact('student'));
    }

    /**
     * @param string $id
     * @return Container|mixed|object
     */
    public function semester(string $id) {
        $student = $this->studentService->find($id);
        $student->load(['user', 'faculty', 'semesters' => function($query) {
            return $query->orderBy('order', 'desc');
        }]);

        return view($this->view.'details.semester.index', compact('student'));
    }

    public function result(string $id) {
        $student = $this->studentService->find($id);
        $student->load(['user', 'faculty', 'results']);

        $response = DB::table('results')
            ->join('subjects', 'subjects.id', '=', 'subject_id')
            ->join('semesters', 'semesters.id', '=', 'subjects.semester_id')
            ->join('exams', 'exams.id', '=', 'results.exam_id')
            ->join('exam_types', 'exam_types.id', '=', 'exams.exam_type_id')
            ->where('student_id', $id);

        $semesterExams = $response->select('exams.name as exam', 'exam_types.name as examType', 'semesters.name as semester')
            ->distinct('exam', 'examType', 'semester')->orderBy('semesters.display_name', 'asc')->orderBy('exams.name', 'asc')->get();

        $semesterExamsData = [];
        foreach($semesterExams as $se) {
            $semesterExamsData[$se->semester][] = [
                'exam' => $se->exam,
                'examType' => $se->examType,
            ];
        }
        $response = $response->orderBy('semesters.display_name', 'asc')
            ->select('grade', 'remarks', 'subjects.name as subject', 'semesters.name as semester', 'exams.name as exam', 'exam_types.name as examType')
            ->get();

        $results = [];
        foreach ($semesterExamsData as  $key => $sed) {
            foreach ($response as  $value) {
                if($key == $value->semester)
                {
                    foreach ($sed as $data) {
                        $results[$key][$value->subject][$data['exam'] . ' ' . $data['examType']] = "";
                    }
                }
            }
        }
        foreach ($semesterExamsData as  $key => $sed) {
            foreach ($response as  $value) {
                foreach ($sed as $data) {
                    if ($data['exam'] == $value->exam && $data['examType'] == $value->examType && $key == $value->semester) {
                        $results[$value->semester][$value->subject][$data['exam'] . ' ' . $data['examType']] = $value->grade;
                    }
                }
            }
        }

        return view($this->view.'details.result.index', compact('student', 'results', 'semesterExamsData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = $this->studentService->find($id);
        $faculties = $this->facultyService->allForDropDown();

        return view($this->view.'edit', compact('student', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, string $id)
    {
        $this->facultyService->update($id, $request->all());

        return $this->facultyService->redirect('admin.student.index', 'success', 'Student updated successfully');
    }

    /**
     * @return Container|mixed|object
     */
    public function import() {
        return view($this->view.'import');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function storeImport(Request $request){
        $file = $request->file('file');
        Excel::import(new UsersImport, $file);

        return $this->studentService->redirect('admin.student.index', 'success', 'Student imported successfully');
    }

    public function exportSample() {
        return Excel::download(new StudentSampleExport, 'student.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->studentService->destroy($id);

        return redirect()->back();
    }
}
