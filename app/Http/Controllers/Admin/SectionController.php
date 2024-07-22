<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SectionRequest;
use App\Services\FacultyService;
use App\Services\SectionService;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * @var string
     */
    private $view = 'admin.section.';
    /**
     * @var SectionService
     */
    private $sectionService;
    /**
     * @var FacultyService
     */
    private $facultyService;

    /**
     * SectionController constructor.
     * @param SectionService $sectionService
     * @param FacultyService $facultyService
     */
    public function __construct(
        SectionService $sectionService,
        FacultyService $facultyService
    )
    {
        $this->sectionService = $sectionService;
        $this->facultyService = $facultyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->sectionService->datatable($request);
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
    public function store(SectionRequest $request)
    {
        $this->sectionService->create($request->all());

        return $this->sectionService->redirect('admin.section.index', 'success', 'Section created successfully');

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
        $section = $this->sectionService->find($id);
        $faculties = $this->facultyService->allForDropDown();

        return view($this->view.'edit', compact('section', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, string $id)
    {
        $this->sectionService->update($id, $request->all());

        return $this->sectionService->redirect('admin.section.index', 'success', 'Section updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->sectionService->destroy($id);

        return redirect()->back();
    }
}
