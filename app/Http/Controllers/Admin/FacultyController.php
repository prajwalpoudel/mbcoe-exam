<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FacultyRequest;
use App\Services\FacultyService;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * @var string
     */
    private $view = 'admin.faculty.';
    /**
     * @var FacultyService
     */
    private $facultyService;

    /**
     * FacultyController constructor.
     * @param FacultyService $facultyService
     */
    public function __construct(
        FacultyService $facultyService
    )
    {
        $this->facultyService = $facultyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->facultyService->datatable($request);
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
    public function store(FacultyRequest $request)
    {
        $this->facultyService->create($request->all());

        return $this->facultyService->redirect('admin.faculty.index', 'success', 'Faculty created successfully');
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
        $faculty = $this->facultyService->find($id);

        return view($this->view.'edit', compact('faculty'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FacultyRequest $request, string $id)
    {
        $this->facultyService->update($id, $request->all());

        return $this->facultyService->redirect('admin.faculty.index', 'success', 'Faculty updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->facultyService->destroy($id);

        return redirect()->back();
    }
}
