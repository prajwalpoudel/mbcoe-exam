<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExamRequest;
use App\Services\ExamService;
use App\Services\ExamTypeService;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * @var string
     */
    private $view = 'admin.exam.';
    /**
     * @var ExamService
     */
    private $examService;
    /**
     * @var ExamTypeService
     */
    private $examTypeService;

    /**
     * ExamController constructor.
     * @param ExamService $examService
     * @param ExamTypeService $examTypeService
     */
    public function __construct(
        ExamService $examService,
        ExamTypeService $examTypeService
    )
    {
        $this->examService = $examService;
        $this->examTypeService = $examTypeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->examService->datatable($request);
        }
        return view($this->view . 'index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $examTypes = $this->examTypeService->allForDropDown();

        return view($this->view.'create', compact('examTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamRequest $request)
    {
        $this->examService->create($request->all());

        return $this->examService->redirect('admin.exam.index', 'success', 'Exam created successfully');
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
        $exam = $this->examService->find($id);
        $examTypes = $this->examService->allForDropDown();
        return view($this->view.'edit', compact('exam', 'examTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamRequest $request, string $id)
    {
        $this->examService->update($id, $request->all());

        return $this->examService->redirect('admin.exam.index', 'success', 'Exam updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->examService->destroy($id);

        return redirect()->back();
    }
}
