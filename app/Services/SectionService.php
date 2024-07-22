<?php


namespace App\Services;


use App\Models\Section;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SectionService extends BaseService
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
        return Section::class;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function datatable(Request $request)
    {
        $sections = $this->query()->with(['faculty', 'semester'])->get();
        return $this->dataTables->of($sections)
            ->addColumn('action', function ($section) {
                $params = [
                    'route' => 'admin.section',
                    'id' => $section->id,
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
