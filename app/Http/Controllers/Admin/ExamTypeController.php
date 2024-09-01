<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExamTypeRequest;
use App\Services\ExamTypeService;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    /**
     * @var string
     */
    private $view = 'admin.exam-type.';
    /**
     * @var ExamTypeService
     */
    private $examTypeService;
    /**
     * ExamTypeController constructor.
     * @param ExamTypeService $examTypeService
     */
    public function __construct(
        ExamTypeService $examTypeService
    )
    {
        $this->examTypeService = $examTypeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->examTypeService->datatable($request);
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
    public function store(ExamTypeRequest $request)
    {
        $this->examTypeService->create($request->all());

        return $this->examTypeService->redirect('admin.exam-type.index', 'success', 'Exam Type created successfully');
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
        $examType = $this->examTypeService->find($id);

        return view($this->view.'edit', compact('examType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamTypeRequest $request, string $id)
    {
        $this->examTypeService->update($id, $request->all());

        return $this->examTypeService->redirect('admin.exam-type.index', 'success', 'Exam Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->examTypeService->destroy($id);

        return redirect()->back();
    }
}
