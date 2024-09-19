<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SubjectExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubjectRequest;
use App\Imports\SubjectImport;
use App\Services\FacultyService;
use App\Services\SubjectService;
use App\Services\SyllabusService;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SubjectController extends Controller
{
    /**
     * @var string
     */
    private $view = 'admin.subject.';
    /**
     * @var SubjectService
     */
    private $subjectService;
    /**
     * @var FacultyService
     */
    private $facultyService;
    /**
     * @var SyllabusService
     */
    private $syllabusService;

    /**
     * SubjectController constructor.
     * @param SubjectService $subjectService
     * @param FacultyService $facultyService
     * @param SyllabusService $syllabusService
     */
    public function __construct(
        SubjectService $subjectService,
        FacultyService $facultyService,
        SyllabusService $syllabusService
    )
    {
        $this->subjectService = $subjectService;
        $this->facultyService = $facultyService;
        $this->syllabusService = $syllabusService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->subjectService->datatable($request);
        }
        return view($this->view . 'index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = $this->facultyService->select2DropDown('Select Faculty');
        $syllabi = $this->syllabusService->select2DropDown('Select Syllabus');

        return view($this->view.'create', compact('faculties', 'syllabi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        $this->subjectService->create($request->all());

        return $this->subjectService->redirect('admin.subject.index', 'success', 'Subject created successfully');
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
        $subject = $this->subjectService->find($id)->load('semester');
        $faculties = $this->facultyService->select2DropDown('Select Faculty');
        $syllabi = $this->syllabusService->select2DropDown('Select Syllabus');

        return view($this->view.'edit', compact('subject', 'faculties', 'syllabi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, string $id)
    {
        $this->subjectService->update($id, $request->all());

        return $this->subjectService->redirect('admin.subject.index', 'success', 'Subject updated successfully');
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
        Excel::import(new SubjectImport, $file);

        return $this->subjectService->redirect('admin.subject.index', 'success', 'Subject imported successfully');
    }

    public function exportSample() {
        return Excel::download(new SubjectExport, 'subject.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->subjectService->destroy($id);

        return redirect()->back();
    }
}
