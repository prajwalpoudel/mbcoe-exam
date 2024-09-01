<?php

namespace Database\Seeders;

use App\Constants\MenuGroupConstant;
use App\Services\MenuService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{
    /**
     * @var MenuService
     */
    private $menuService;

    /**
     * MenuTableSeeder constructor.
     * @param MenuService $menuService
     */
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            // Admin dashboard menus
            [
                "title" => "Dashboard",
                "class" => "nav-item",
                "order" => 1,
                "icon" => "fa fa-envelope",
                "is_active" => true,
                "route" => "admin.dashboard",
                "group_id" => MenuGroupConstant::ADMIN_ID,
                "children" => [

                ],
                "related_routes" => 'admin.dashboard',
            ],
            [
                "title" => "Syllabus",
                "class" => "nav-item",
                "order" => 2,
                "icon" => "fa fa-envelope",
                "is_active" => true,
                "route" => "admin.syllabus.index",
                "group_id" => MenuGroupConstant::ADMIN_ID,
                "children" => [

                ],
                "related_routes" => [
                    'admin.syllabus.index',
                    'admin.syllabus.create',
                    'admin.syllabus.edit',
                    'admin.syllabus.destroy',
                ],
            ],
            [
                "title" => "Batch",
                "class" => "nav-item",
                "order" => 2,
                "icon" => "fa fa-envelope",
                "is_active" => true,
                "route" => "admin.batch.index",
                "group_id" => MenuGroupConstant::ADMIN_ID,
                "children" => [

                ],
                "related_routes" => [
                    'admin.batch.index',
                    'admin.batch.create',
                    'admin.batch.edit',
                    'admin.batch.destroy',
                ],
            ],
            [
                "title" => "Faculty",
                "class" => "nav-item",
                "order" => 2,
                "icon" => "fa fa-envelope",
                "is_active" => true,
                "route" => "admin.faculty.index",
                "group_id" => MenuGroupConstant::ADMIN_ID,
                "children" => [

                ],
                "related_routes" => [
                    'admin.faculty.index',
                    'admin.faculty.create',
                    'admin.faculty.edit',
                    'admin.faculty.destroy',
                ],
            ],
            [
                "title" => "Semester",
                "class" => "nav-item",
                "order" => 2,
                "icon" => "fa fa-envelope",
                "is_active" => true,
                "route" => "admin.semester.index",
                "group_id" => MenuGroupConstant::ADMIN_ID,
                "children" => [

                ],
                "related_routes" => [
                    'admin.semester.index',
                    'admin.semester.create',
                    'admin.semester.edit',
                    'admin.semester.destroy',
                ],
            ],
            [
                "title" => "Section",
                "class" => "nav-item",
                "order" => 2,
                "icon" => "fa fa-envelope",
                "is_active" => true,
                "route" => "admin.section.index",
                "group_id" => MenuGroupConstant::ADMIN_ID,
                "children" => [

                ],
                "related_routes" => [
                    'admin.section.index',
                    'admin.section.create',
                    'admin.section.edit',
                    'admin.section.destroy',
                ],
            ],
            [
                "title" => "Subject",
                "class" => "nav-item",
                "order" => 2,
                "icon" => "fa fa-envelope",
                "is_active" => true,
                "route" => "admin.subject.index",
                "group_id" => MenuGroupConstant::ADMIN_ID,
                "children" => [

                ],
                "related_routes" => [
                    'admin.subject.index',
                    'admin.subject.create',
                    'admin.subject.edit',
                    'admin.subject.destroy',
                ],
            ],
            [
                "title" => "Exam Type",
                "class" => "nav-item",
                "order" => 2,
                "icon" => "fa fa-envelope",
                "is_active" => true,
                "route" => "admin.exam-type.index",
                "group_id" => MenuGroupConstant::ADMIN_ID,
                "children" => [

                ],
                "related_routes" => [
                    'admin.exam-type.index',
                    'admin.exam-type.create',
                    'admin.exam-type.edit',
                    'admin.exam-type.destroy',
                ],
            ],
            [
                "title" => "Exam",
                "class" => "nav-item",
                "order" => 2,
                "icon" => "fa fa-envelope",
                "is_active" => true,
                "route" => "admin.exam.index",
                "group_id" => MenuGroupConstant::ADMIN_ID,
                "children" => [

                ],
                "related_routes" => [
                    'admin.exam.index',
                    'admin.exam.create',
                    'admin.exam.edit',
                    'admin.exam.destroy',
                ],
            ],
            [
                "title" => "Student",
                "class" => "nav-item",
                "order" => 1,
                "icon" => "fa fa-envelope",
                "is_active" => true,
                "route" => "admin.student.index",
                "group_id" => MenuGroupConstant::ADMIN_ID,
                "children" => [

                ],
                "related_routes" => [
                    'admin.student.index',
                    'admin.student.create',
                    'admin.student.edit',
                ]
            ],
            [
                "title" => "Result",
                "class" => "nav-item",
                "order" => 1,
                "icon" => "fa fa-envelope",
                "is_active" => true,
                "route" => "admin.result.index",
                "group_id" => MenuGroupConstant::ADMIN_ID,
                "children" => [

                ],
                "related_routes" => [
                    'admin.result.index',
                    'admin.result.create',
                    'admin.result.edit',
                ]
            ],
        ];

        $groups = [
            [
                'title' => MenuGroupConstant::ADMIN,
                'order' => 1,
            ],
            [
                'title' => MenuGroupConstant::STUDENT,
                'order' => 2,
            ],
        ];

        DB::table('menu_groups')->truncate();
        DB::table('menus')->truncate();
        DB::table('menu_groups')->insert($groups);

        foreach ($menus as $menu) {
            $childrenMenus = $menu['children'];
            unset($menu['children']);
            if (!empty($menu['related_routes']) && is_array($menu['related_routes'])) {
                $menu['related_routes'] = implode(',', array_map('trim', $menu['related_routes']));
            }
            $parentMenu = $this->menuService->create($menu);
            foreach ($childrenMenus as $childrenMenu) {
                if (!empty($childrenMenu['related_routes']) && is_array($childrenMenu['related_routes'])) {
                    $childrenMenu['related_routes'] = implode(',', array_map('trim', $childrenMenu['related_routes']));
                }
                $childrenMenu['parent_id'] = $parentMenu->id;
                $this->menuService->updateOrCreate($childrenMenu, $childrenMenu);
            }
        }
    }
}
