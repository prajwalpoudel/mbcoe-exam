<?php


namespace App\Services;


use App\Models\Exam;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExamService extends BaseService
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
        return Exam::class;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function datatable(Request $request)
    {
        $exams = $this->query()->with(['type'])->get();
        return $this->dataTables->of($exams)
            ->addColumn('action', function ($exam) {
                $params = [
                    'route' => 'admin.exam',
                    'id' => $exam->id,
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
