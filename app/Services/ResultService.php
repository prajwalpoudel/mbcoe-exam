<?php


namespace App\Services;


use App\Models\Result;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ResultService extends BaseService
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
        return Result::class;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function datatable(Request $request)
    {
        $results = DB::table('results')
            ->join('students', 'results.student_id', '=', 'students.id')
            ->join('faculties', 'students.faculty_id', '=', 'faculties.id')
            ->join('subjects', 'results.subject_id', '=', 'subjects.id')
            ->join('semesters', 'subjects.semester_id', '=', 'semesters.id')
            ->join('exams', 'results.exam_id', '=', 'exams.id')
            ->join('exam_types', 'exams.exam_type_id', '=', 'exam_types.id')
            ->select('results.id as id', 'faculties.name as faculty', 'semesters.name as semester', 'exams.name as exam', 'exam_types.name as exam_type', DB::raw('count(*) as result_count'))
            ->groupBy('faculty', 'semester', 'exam', 'exam_type')
            ->where('results.deleted_at', null)
            ->get();

        return $this->dataTables->of($results)
            ->addColumn('action', function ($result) {
                $params = [
                    'route' => 'admin.result',
                    'id' => $result->id,
                    'edit' => false,
                    'delete' => false,
                    'show' => true
                ];

                return view('admin.datatable.action', compact('params'));
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function studentWiseDatatable(Request $request, array $where, $redirect = 'admin.student.result')
    {
        $results = $this->query()
            ->join('exams', 'exams.id', '=', 'results.exam_id')
            ->join('subjects', 'subjects.id', '=', 'results.subject_id')
            ->join('students', 'students.id', '=', 'results.student_id')
            ->join('semesters', 'subjects.semester_id', '=', 'semesters.id')
            ->join('faculties', 'students.faculty_id', '=', 'faculties.id')
            ->join('exam_types', 'exam_types.id', '=', 'exams.exam_type_id')
            ->join('users', 'users.id', '=', 'students.user_id')
            ->where($where)
            ->select('results.id as id','subjects.name as subject', 'exams.name as exam', 'exam_types.name as exam_type', 'grade', 'remarks', 'users.name as name');

        return DataTables::of($results)
            ->addColumn('action', function ($result) use($redirect) {
                $params = [
                    'route' => $redirect,
                    'id' => $result->id,
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
