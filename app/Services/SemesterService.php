<?php


namespace App\Services;


use App\Models\Semester;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SemesterService extends BaseService
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
        return Semester::class;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function datatable(Request $request)
    {
        $semesters = $this->query()->with(['faculty'])->get();
        return $this->dataTables->of($semesters)
            ->addColumn('action', function ($semester) {
                $params = [
                    'route' => 'admin.semester',
                    'id' => $semester->id,
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
