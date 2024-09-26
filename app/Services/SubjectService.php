<?php


namespace App\Services;


use App\Models\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubjectService extends BaseService
{
    /**
     * @var DataTables
     */
    private $dataTables;

    /**
     * SyllabusService constructor.
     * @param DataTables $dataTables
     */
    public function __construct(
        DataTables $dataTables
    )
    {
        parent::__construct();
        $this->dataTables = $dataTables;
    }

    public function model()
    {
        return Subject::class;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function datatable(Request $request)
    {
        $subjects = $this->query()
            ->join('faculties', 'faculties.id', '=', 'subjects.faculty_id')
            ->join('semesters', 'semesters.id', '=', 'subjects.semester_id')
            ->join('syllabi', 'syllabi.id', '=', 'subjects.syllabus_id')
            ->select('subjects.id as id','subjects.name as name', 'subjects.code as code', 'faculties.name as faculty', 'semesters.name as semester', 'syllabi.name as syllabus', 'credit_hour');

        return DataTables::of($subjects)
            ->addColumn('action', function ($subject) {
                $params = [
                    'route' => 'admin.subject',
                    'id' => $subject->id,
                    'edit' => true,
                    'delete' => true,
                ];

                return view('admin.datatable.action', compact('params'));
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
