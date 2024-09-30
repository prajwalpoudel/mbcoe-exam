<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ResultExport;
use App\Exports\StudentSampleExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudentRequest;
use App\Imports\ResultImport;
use App\Imports\UsersImport;
use App\Models\Faculty;
use App\Services\BatchService;
use App\Services\ExamService;
use App\Services\FacultyService;
use App\Services\ResultService;
use App\Services\SemesterService;
use App\Services\SyllabusService;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResultController extends Controller
{
    /**
     * @var string
     */
    private $view = 'admin.result.';
    /**
     * @var ResultService
     */
    private $resultService;
    /**
     * @var ExamService
     */
    private $examService;
    /**
     * @var FacultyService
     */
    private $facultyService;
    /**
     * @var SyllabusService
     */
    private $syllabusService;
    /**
     * @var SemesterService
     */
    private $semesterService;

    /**
     * ResultController constructor.
     * @param ResultService $resultService
     * @param ExamService $examService
     * @param FacultyService $facultyService
     * @param SyllabusService $syllabusService
     * @param SemesterService $semesterService
     */
    public function __construct(
        ResultService $resultService,
        ExamService $examService,
        FacultyService $facultyService,
        SyllabusService $syllabusService,
        SemesterService $semesterService
    )
    {
        $this->resultService = $resultService;
        $this->examService = $examService;
        $this->facultyService = $facultyService;
        $this->syllabusService = $syllabusService;
        $this->semesterService = $semesterService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->resultService->datatable($request);
        }
        return view($this->view . 'index');
    }

    public function show() {

    }

    /**
     * @return Container|mixed|object
     */
    public function import() {
        $exams = $this->examService->all();
        $exams = $exams->pluck('exam_name', 'id');
        $syllabi = $this->syllabusService->query()->pluck('name', 'id');
        $faculties = $this->facultyService->query()->pluck('name', 'id');

        return view($this->view.'import', compact('exams', 'syllabi', 'faculties'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function storeImport(Request $request){
        $file = $request->file('file');
        $data = $request->only(['exam_id', 'syllabus_id', 'faculty_id', 'semester_id']);
        Excel::import(new ResultImport($data), $file);


        return $this->resultService->redirect('admin.result.index', 'success', 'Result imported successfully');
    }

    /**
     * @return Container|mixed|object
     */
    public function export() {
        $faculties = $this->facultyService->query()->pluck('name', 'id');
        $syllabi = $this->syllabusService->query()->pluck('name', 'id');

        return view($this->view.'export', compact('faculties', 'syllabi'));
    }

    /**
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function exportSample(Request $request) {
        $semester = $this->semesterService->find($request->input('semester_id'))->name;
        $faculty = $this->facultyService->find($request->input('faculty_id'))->name;
        return Excel::download(new ResultExport($request->all()), 'result'.$faculty.'-'.$semester.'.xlsx');
    }
}
