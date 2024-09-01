<?php


namespace App\Services;

use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StudentService extends BaseService
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
        return Student::class;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function datatable(Request $request)
    {
        $students = $this->query()->with(['user', 'faculty', 'semester'])->get();
        return $this->dataTables->of($students)
            ->addColumn('action', function ($student) {
                $params = [
                    'route' => 'admin.student',
                    'id' => $student->id,
                    'edit' => true,
                    'delete' => true,
                    'show' => true
                ];

                return view('admin.datatable.action', compact('params'));
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
