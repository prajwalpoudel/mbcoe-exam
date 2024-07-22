<?php


namespace App\Services;


use App\Models\Faculty;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FacultyService extends BaseService
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
        return Faculty::class;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function datatable(Request $request)
    {
        $faculties = $this->all();
        return $this->dataTables->of($faculties)
            ->addColumn('action', function ($faculty) {
                $params = [
                    'route' => 'admin.faculty',
                    'id' => $faculty->id,
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
