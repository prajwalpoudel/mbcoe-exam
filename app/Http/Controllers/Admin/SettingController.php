<?php

namespace App\Http\Controllers\Admin;

use App\Constants\StatusConstant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use App\Services\FacultyService;
use App\Services\SemesterService;
use App\Services\SettingService;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * @var string
     */
    private $view = 'admin.settings.';
    /**
     * @var SettingService
     */
    private $settingService;
    /**
     * @var FacultyService
     */
    private $facultyService;
    /**
     * @var StudentService
     */
    private $studentService;
    /**
     * @var SemesterService
     */
    private $semesterService;

    /**
     * SettingController constructor.
     * @param SettingService $settingService
     * @param FacultyService $facultyService
     * @param StudentService $studentService
     * @param SemesterService $semesterService
     */
    public function __construct(
        SettingService $settingService,
        FacultyService $facultyService,
        StudentService $studentService,
        SemesterService $semesterService
    )
    {
        $this->settingService = $settingService;
        $this->facultyService = $facultyService;
        $this->studentService = $studentService;
        $this->semesterService = $semesterService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = $this->settingService->query()->first();

        return view($this->view . 'index', compact('setting'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $setting = $this->settingService->find($id);

        return view($this->view.'edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, string $id)
    {
        $setting = $this->settingService->find($id);
        $settingData = $request->all();
        if($request->hasFile('logo')) {
            if (!is_null($setting->logo) && Storage::exists($setting->logo)) {
                Storage::delete($setting->logo);
            }

            $path = Storage::putFile('logo', $request->file('logo'));
            $settingData['logo'] = $path;
        }

        $setting->update($settingData);

        return $this->settingService->redirect('admin.setting.index', 'success', 'Setting updated successfully');
    }

    public function semester() {
        $faculties = $this->facultyService->select2DropDown('All Faculty');

        return view($this->view.'semester.edit', compact('faculties'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Container\Container|mixed|object
     */
    public function updateSemester(Request $request) {
        DB::beginTransaction();
        $faculty = $request->input('faculty_id');
        $students = $this->studentService->query()
            ->withWhereHas('semesters', function($query) {
                $query->where('status', StatusConstant::RUNNING)
                    ->where('is_current', true);
            });
        if($faculty) {
            $students->where('faculty_id', $faculty);
        }
        $students = $students->get();
        foreach($students as $student) {
            $currentSemester = $student->semesters[0];
            $semester = $this->semesterService->where(['faculty_id' => $currentSemester->faculty_id, 'order' => $currentSemester->order+1])->first();
            $student->semesters()->updateExistingPivot($currentSemester, [
                'is_current' => false,
            ]);
            $student->semesters()->attach($semester, ['is_current' => true]);
        }
        DB::commit();
        return $this->studentService->redirect('admin.setting.index', 'success', 'Semesters Updated successfully');
    }
}
