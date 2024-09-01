<?php


namespace App\Services;


use App\Models\ExamType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExamTypeService extends BaseService
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
        return ExamType::class;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function datatable(Request $request)
    {
        $examTypes = $this->all();
        return $this->dataTables->of($examTypes)
            ->addColumn('action', function ($examType) {
                $params = [
                    'route' => 'admin.exam-type',
                    'id' => $examType->id,
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
