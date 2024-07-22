<?php


namespace App\Services;


use App\Models\Batch;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BatchService extends BaseService
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
        return Batch::class;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function datatable(Request $request)
    {
        $batches = $this->query()->with(['syllabus'])->get();
        return $this->dataTables->of($batches)
            ->addColumn('action', function ($batch) {
                $params = [
                    'route' => 'admin.batch',
                    'id' => $batch->id,
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
