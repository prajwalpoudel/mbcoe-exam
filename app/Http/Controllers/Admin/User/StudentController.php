<?php

namespace App\Http\Controllers\Admin\User;

use App\Constants\StatusConstant;
use App\Exports\StudentSampleExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudentRequest;
use App\Imports\UsersImport;
use App\Models\Result;
use App\Models\Subject;
use App\Services\BatchService;
use App\Services\FacultyService;
use App\Services\SemesterService;
use App\Services\StudentService;
use Barryvdh\DomPDF\Facade\Pdf;
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
     * @var SemesterService
     */
    private $semesterService;

    /**
     * StudentController constructor.
     * @param StudentService $studentService
     * @param FacultyService $facultyService
     * @param BatchService $batchService
     * @param SemesterService $semesterService
     */
    public function __construct(
        StudentService $studentService,
        FacultyService $facultyService,
        BatchService $batchService,
        SemesterService $semesterService
    )
    {
        $this->studentService = $studentService;
        $this->facultyService = $facultyService;
        $this->batchService = $batchService;
        $this->semesterService = $semesterService;
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
        $response = $this->studentService->result($id);
        $student = $response['student'];
        $data = $response['data'];
        $exams = $response['exams'];

        return view($this->view.'details.result.index', compact('student', 'data', 'exams'));
    }

    public function transcript(string $id) {
        $response = $this->studentService->result($id);
        $student = $response['student'];
        $data = $response['data'];
        $exams = $response['exams'];

        $pdf = Pdf::loadView($this->view.'details.result.pdf.transcript', compact('exams', 'data', 'student'));
        return $pdf->stream('transcript-'.$student->user->name.'.pdf');
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
        set_time_limit(300);
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
