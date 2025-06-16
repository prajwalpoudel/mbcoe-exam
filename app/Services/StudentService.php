<?php


namespace App\Services;

use App\Models\Student;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $students = $this->query()
            ->join('users', 'users.id', '=', 'students.user_id')
            ->join('faculties', 'faculties.id', '=', 'students.faculty_id')
            ->join('semester_student', function(JoinClause $join) {
                $join->on('students.id', '=', 'semester_student.student_id')
                    ->where('is_current', true);
            })
            ->join('semesters', 'semesters.id', '=', 'semester_student.semester_id')
            ->select('students.id as id','users.name as name', 'users.email as email',  'users.address as address', 'users.phone as phone', 'symbol_no', 'registration_number', 'faculties.name as faculty',  'semesters.name as semester');
        if($facultyId = $request->faculty) {
            $students->where('faculties.id', $facultyId);
        }
        if($semester = $request->semester) {
            $students->where('semesters.name', $semester);
        }
        return DataTables::of($students)
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

    public function result(string $id) {
        $student = $this->find($id)->load('batch', 'user');
        $student = $student->load(['semesters' => function($query) {
            return $query->wherePivot('is_current', false)->orderBy('order', 'asc');
        }, 'semesters.subjects' => function($query) use($student) {
            return $query->where('syllabus_id', $student->batch->syllabus_id);
        }]);
        $resultResponse = DB::table('results')->where('student_id', $student->id)
            ->join('subjects', 'subjects.id', '=', 'subject_id')
            ->join('semesters', 'subjects.semester_id', '=', 'semesters.id')
            ->join('exams', 'results.exam_id', '=', 'exams.id')
            ->join('exam_types', 'exams.exam_type_id', '=', 'exam_types.id')
            ->whereNull('results.deleted_at');

        $exams = (clone $resultResponse)->select('exams.name as exam', 'exam_types.name as examType', 'semesters.display_name as semester', 'exams.order as order')
            ->groupBy('exam', 'examType', 'semester')->orderBy('order', 'asc')->get();
        $results = (clone $resultResponse)->select('exams.name as exam', 'exams.order as order', 'exam_types.name as examType', 'semesters.display_name as semester', 'subjects.name as subject', 'grade')
            ->orderBy('order', 'asc')
            ->get();


        $data = [];
        foreach($student->semesters as $semester) {
            for($i = 0; $i < $semester->no_of_elective; $i++) {
                $data[$semester->display_name]['Elective ' . $i + 1][] = '';
            }
        }
        foreach($student->semesters as $semester) {
            $electiveCount = 0;
            foreach($semester->subjects as $subject) {
                foreach($results as $result) {
                    if($result->semester == $semester->display_name ) {
                        if($subject->name == $result->subject) {
                            if($subject->is_elective) {
                                $electiveCount++;
                                unset($data[$semester->display_name]['Elective '.$electiveCount ]);
                            }
                            $data[$semester->display_name][$subject->name][$result->exam.' '.$result->examType] = $result->grade;
                        }
                        else {
                            if(!isset($data[$semester->display_name][$subject->name][$result->exam.' '.$result->examType])) {
                                if(!$subject->is_elective ) {
                                    $data[$semester->display_name][$subject->name][$result->exam.' '.$result->examType] = "";
                                }
                            }
                        }
                    }
                }
            }
        }
        ksort($data);

        $response = [
            'student' => $student,
            'data' => $data,
            'exams' => $exams
        ];

        return $response;
    }
}
