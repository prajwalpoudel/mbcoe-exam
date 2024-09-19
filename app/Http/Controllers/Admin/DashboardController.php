<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\BatchService;
use App\Services\FacultyService;
use App\Services\StudentService;
use App\Services\SubjectService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @var SubjectService
     */
    private $subjectService;
    /**
     * @var BatchService
     */
    private $batchService;
    /**
     * @var FacultyService
     */
    private $facultyService;
    /**
     * @var StudentService
     */
    private $studentService;

    /**
     * DashboardController constructor.
     * @param SubjectService $subjectService
     * @param BatchService $batchService
     * @param FacultyService $facultyService
     * @param StudentService $studentService
     */
    public function __construct(
        SubjectService $subjectService,
        BatchService $batchService,
        FacultyService $facultyService,
        StudentService $studentService
    ) {

        $this->subjectService = $subjectService;
        $this->batchService = $batchService;
        $this->facultyService = $facultyService;
        $this->studentService = $studentService;
    }
    public function index() {
        $batchCount = $this->batchService->query()->count() - 1;
        $facultyCount = $this->facultyService->query()->count() - 1;
        $subjectCount = $this->subjectService->query()->count() - 1;
        $studentCount = $this->studentService->query()->count() - 1;

        return view('admin.dashboard.index', compact('batchCount', 'facultyCount', 'subjectCount', 'studentCount'));
    }
}
