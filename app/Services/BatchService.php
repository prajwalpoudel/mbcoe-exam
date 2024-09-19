<?php


namespace App\Services;


use App\Models\Batch;
use App\Models\Result;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BatchService extends BaseService
{
    /**
     * @var DataTables
     */
    private $dataTables;
    /**
     * @var StudentService
     */
    private $studentService;

    /**
     * SyllabusService constructor.
     * @param DataTables $dataTables
     * @param StudentService $studentService
     */
    public function __construct(
        DataTables $dataTables,
        StudentService $studentService
    )
    {
        parent::__construct();
        $this->dataTables = $dataTables;
        $this->studentService = $studentService;
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
                    'show' => true
                ];

                return view('admin.datatable.action', compact('params'));
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function result(Request $request)
    {
        $grades = ['A+', 'A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-'];
        $resultCount = 1;
        $students = $this->studentService->where(['batch_id' => $request->batch])->where('faculty_id', $request->faculty)->with(['semesters' => function($query) {
            return $query->where('is_current', false);
        }, 'user'])->get();
        $selectedSemester = Semester::where('faculty_id', $request->faculty)->where('name', $request->semester)->first();
        $semesters = Semester::where('faculty_id', $request->faculty)->where('order', '<=', $selectedSemester->order)->pluck('id')->toArray();
        $subjects = Subject::whereIn('semester_id', $semesters)->where('syllabus_id', $request->syllabus)->get();
        if(count($students)) {
            foreach($students as $key => $student) {
                foreach($subjects as $subject) {
                    if($subject->is_elective) {
                        $resultCount = $subject->semester->no_of_elective;
                        $electives = $subjects->where('is_elective' , true)->where('semester_id', $subject->semester_id)->pluck('id');
                        $result = Result::where('student_id', $student->id)->whereIn('subject_id', $electives)->whereIn('grade', $grades)->get();
                        $subjects->forget($electives);
                    }
                    else {
                        $result = Result::where('student_id', $student->id)->where('subject_id', $subject->id)->whereIn('grade', $grades)->get();
                    }
                    if(count($result) < $resultCount) {
                        $students->forget($key);
                        break;
                    }
                }
            }
        }
        return $this->dataTables->of($students)
            ->addColumn('action', function ($student) {
                $params = [
                    'route' => 'admin.student',
                    'id' => $student->id,
                    'show' => true
                ];

                return view('admin.datatable.action', compact('params'));
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }
}
