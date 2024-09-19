<?php

namespace App\Http\Controllers\Admin;

use App\Constants\StatusConstant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BatchRequest;
use App\Services\BatchService;
use App\Services\FacultyService;
use App\Services\SemesterService;
use App\Services\SyllabusService;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * @var string
     */
    private $view = 'admin.batch.';
    /**
     * @var BatchService
     */
    private $batchService;
    /**
     * @var SyllabusService
     */
    private $syllabusService;
    /**
     * @var FacultyService
     */
    private $facultyService;
    /**
     * @var SemesterService
     */
    private $semesterService;

    /**
     * BatchController constructor.
     * @param BatchService $batchService
     * @param SyllabusService $syllabusService
     * @param FacultyService $facultyService
     * @param SemesterService $semesterService
     */
    public function __construct(
        BatchService $batchService,
        SyllabusService $syllabusService,
        FacultyService $facultyService,
        SemesterService $semesterService
    )
    {
        $this->batchService = $batchService;
        $this->syllabusService = $syllabusService;
        $this->facultyService = $facultyService;
        $this->semesterService = $semesterService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->batchService->datatable($request);
        }
        return view($this->view . 'index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $syllabi = $this->syllabusService->allForDropDown();

        return view($this->view.'create', compact('syllabi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BatchRequest $request)
    {
        $this->batchService->create($request->all());

        return $this->batchService->redirect('admin.batch.index', 'success', 'Batch created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $batch = $this->batchService->find($id)->load(['syllabus', 'students']);
        $faculties = $this->facultyService->all()->pluck('name', 'id');
        $semesters = $this->semesterService->query()->where('status', StatusConstant::RUNNING)->groupBy('name')->orderBy('id')->pluck('name', 'name');
        return view($this->view.'show', compact('batch', 'faculties', 'semesters'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $batch = $this->batchService->find($id);
        $syllabi = $this->syllabusService->allForDropDown();

        return view($this->view.'edit', compact('batch', 'syllabi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BatchRequest $request, string $id)
    {
        $this->batchService->update($id, $request->all());

        return $this->batchService->redirect('admin.batch.index', 'success', 'Batch updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->batchService->destroy($id);

        return redirect()->back();
    }

    public function result(Request $request) {
        return $this->batchService->result($request);
    }
}
