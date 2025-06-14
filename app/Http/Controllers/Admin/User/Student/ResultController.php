<?php

namespace App\Http\Controllers\Admin\User\Student;

use App\Constants\GradeConstant;
use App\Http\Controllers\Controller;
use App\Services\ExamService;
use App\Services\FacultyService;
use App\Services\ResultService;
use App\Services\StudentService;
use App\Services\SyllabusService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    private $view = 'admin.student.details.result.';
    /**
     * @var StudentService
     */
    private $studentService;
    /**
     * @var FacultyService
     */
    private $facultyService;
    /**
     * @var ExamService
     */
    private $examService;
    /**
     * @var SyllabusService
     */
    private $syllabusService;
    /**
     * @var ResultService
     */
    private $resultService;

    /**
     * ResultController constructor.
     * @param StudentService $studentService
     * @param FacultyService $facultyService
     * @param ExamService $examService
     * @param SyllabusService $syllabusService
     * @param ResultService $resultService
     */
    public function __construct(
        StudentService $studentService,
        FacultyService $facultyService,
        ExamService $examService,
        SyllabusService $syllabusService,
        ResultService $resultService
    )
    {
        $this->studentService = $studentService;
        $this->facultyService = $facultyService;
        $this->examService = $examService;
        $this->syllabusService = $syllabusService;

        $this->resultService = $resultService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(string $id, Request $request)
    {
        if($viewMode = $request->input('view_mode')) {
            $request->session()->put('view_mode', $viewMode);
        }
        if ($request->wantsJson()) {
            return $this->resultService->studentWiseDatatable($request, ['student_id' => $id]);
        }
        $response = $this->studentService->result($id);
        $student = $response['student'];
        $data = $response['data'];
        $exams = $response['exams'];

        return view($this->view.'index', compact('student', 'data', 'exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $student = $this->studentService->find($id)->load('user');
        $faculties = $this->facultyService->allForDropDown();
        $exams = $this->examService->allForDropDown('exam_name');
        $syllabi = $this->syllabusService->allForDropDown();
        $grades = collect(GradeConstant::GRADES);
        return view($this->view.'create', compact('student', 'faculties', 'exams', 'syllabi', 'grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $result = $this->resultService->find($id)->load('subject.semester');
        $student = $this->studentService->find($result->student_id)->load('user');
        $faculties = $this->facultyService->allForDropDown();
        $exams = $this->examService->allForDropDown('exam_name');
        $syllabi = $this->syllabusService->allForDropDown();
        $grades = collect(GradeConstant::GRADES);

        return view($this->view.'edit', compact('result','student', 'faculties', 'exams', 'syllabi', 'grades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function transcript(string $id) {
        $response = $this->studentService->result($id);
        $student = $response['student'];
        $data = $response['data'];
        $exams = $response['exams'];

        $pdf = Pdf::loadView($this->view.'pdf.transcript', compact('exams', 'data', 'student'));
        return $pdf->stream('transcript-'.$student->user->name.'.pdf');
    }

}
