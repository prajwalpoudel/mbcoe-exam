<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SyllabusService;
use Illuminate\Http\Request;

class SyllabusController extends Controller
{
    /**
     * @var string
     */
    private $view = 'admin.syllabus.';
    /**
     * @var SyllabusService
     */
    private $syllabusService;

    /**
     * SyllabusController constructor.
     * @param SyllabusService $syllabusService
     */
    public function __construct(
        SyllabusService $syllabusService
    )
    {
        $this->syllabusService = $syllabusService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->syllabusService->datatable($request);
        }
        return view($this->view . 'index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->view.'create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->syllabusService->create($request->all());

        return $this->syllabusService->redirect('admin.syllabus.index', 'success', 'Syllabus created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $syllabus = $this->syllabusService->find($id);

        return view($this->view.'edit', compact('syllabus'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->syllabusService->update($id, $request->all());

        return $this->syllabusService->redirect('admin.syllabus.index', 'success', 'Syllabus updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->syllabusService->destroy($id);

        return redirect()->back();
    }
}
