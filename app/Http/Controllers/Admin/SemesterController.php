<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SemesterRequest;
use App\Services\FacultyService;
use App\Services\SemesterService;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * @var string
     */
    private $view = 'admin.semester.';
    /**
     * @var SemesterService
     */
    private $semesterService;
    /**
     * @var FacultyService
     */
    private $facultyService;

    /**
     * SemesterController constructor.
     * @param SemesterService $semesterService
     * @param FacultyService $facultyService
     */
    public function __construct(
        SemesterService $semesterService,
        FacultyService $facultyService
    )
    {
        $this->semesterService = $semesterService;
        $this->facultyService = $facultyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->semesterService->datatable($request);
        }
        return view($this->view . 'index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = $this->facultyService->allForDropDown();

        return view($this->view.'create', compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SemesterRequest $request)
    {
        $this->semesterService->create($request->all());

        return $this->semesterService->redirect('admin.semester.index', 'success', 'Semester created successfully');
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
        $semester = $this->semesterService->find($id);
        $faculties = $this->facultyService->allForDropDown();

        return view($this->view.'edit', compact('semester', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SemesterRequest $request, string $id)
    {
        $this->semesterService->update($id, $request->all());

        return $this->semesterService->redirect('admin.semester.index', 'success', 'Semester updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->semesterService->destroy($id);

        return redirect()->back();
    }

    public function getSemestersByFaculty($facultyId) {
        $semesters = $this->semesterService->getWhere(['faculty_id' => $facultyId]);

        return response()->json($semesters);
    }
}
