<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->composeSidebar();
    }

    protected function composeSidebar()
    {
        app()->booted(function () {
            // Define your sidebar items here. This could be dynamic based on database queries or static data.
            $sidebarItems = [
                [
                    'level' => 2,
                    'childs' => [
                        [
                            'title' => 'الصفحه الرئيسيه',
                            'url' => route('dashboard.home'), 
                            'icon' => 'ti-home',
                            'main_url' => 'dashboard/home'
                        ]
                    ]
                ],
                [
                    'level' => 1,
                    'title' => "العناصر الرئيسيه",
                    'childs' => [
                        [
                            'title' => 'المراحل الدراسيه',
                            'main_url' => 'dashboard/grades*',
                            'icon' => 'ti-agenda',
                            'childs' => [
                                ['title' => 'جميع المراحل الدراسيه', 'url' => route('dashboard.grades.index'), 'main_url' => 'dashboard/grades'],
                                ['title' => 'اضافة مرحله دراسيه', 'url' => route('dashboard.grades.create'), 'main_url' => 'dashboard/grades/create'],
                            ]
                        ],
                        [
                            'title' => 'الاقسام',
                            'icon' => 'ti-archive',
                            'main_url' => 'dashboard/categories*',
                            'childs' => [
                                ['title' => 'جميع الاقسام', 'url' => route('dashboard.categories.index'), 'main_url' => 'dashboard/categories'],
                                ['title' => 'اضافة قسم', 'url' => route('dashboard.categories.create'), 'main_url' => 'dashboard/categories/create'],
                            ]
                        ],
                        [
                            'title' => 'المواد الدراسيه',
                            'icon' => 'ti-write',
                            'main_url' => 'dashboard/subjets*',
                            'childs' => [
                                ['title' => 'جميع المواد الدراسيه', 'url' => route('dashboard.subjects.index'), 'main_url' => 'dashboard/subjects'],
                                ['title' => 'اضافة ماده دراسيه', 'url' => route('dashboard.subjects.create'), 'main_url' => 'dashboard/subjects/create'],
                            ]
                        ],
                        [
                            'title' => 'المدرسين',
                            'icon' => 'fa fa-user-secret',
                            'main_url' => 'dashboard/teachers*',
                            'childs' => [
                                ['title' => 'جميع المدرسين', 'url' => route('dashboard.teachers.index'), 'main_url' => 'dashboard/teachers'],
                                ['title' => 'اضافة مدرس', 'url' => route('dashboard.teachers.create'), 'main_url' => 'dashboard/teachers/create']
                            ]
                        ],
                        [
                            'title' => 'الطلاب',
                            'icon' => 'fa fa-users',
                            'main_url' => 'dashboard/students*',
                            'childs' => [
                                ['title' => 'جميع الطلاب', 'url' => route('dashboard.students.index'), 'main_url' => 'dashboard/students/']
                            ]
                        ],
                    ]
                ],
                [
                    'level' => 1,
                    'title' => 'المحتوى التعليمي',
                    'childs' => [
                        [
                            'title' => 'الدروس المسجله',
                            'main_url' => 'dashboard/lessons*',
                            'icon' => 'ti-video-camera',
                            'childs' => [
                                ['title' => 'جميع الفيديوهات', 'url' => route('dashboard.recorded-lessons.index'), 'main_url' => 'dashboard/lessons'],
                                ['title' => 'اضافة فيديو', 'url' => route('dashboard.recorded-lessons.create'), 'main_url' => 'dashboard/lessons/create'],
                            ]
                        ],
                        [
                            'title' => 'الامتحانات',
                            'main_url' => 'dashboard/exams*',
                            'icon' => ' ti-clipboard',
                            'childs' => [
                                ['title' => 'جميع الامتحانات', 'url' => route('dashboard.exams.index'), 'main_url' => 'dashboard/exams'],
                                ['title' => 'اضافة امتحان', 'url' => route('dashboard.exams.create'), 'main_url' => 'dashboard/exams/create'],
                            ]
                        ],
                        [
                            'title' => 'الكتب',
                            'main_url' => 'dashboard/books*',
                            'icon' => ' ti-book',
                            'childs' => [
                                ['title' => 'جميع الكتب', 'url' => route('dashboard.books.index'), 'main_url' => 'dashboard/books'],
                                ['title' => 'اضافة كتاب', 'url' => route('dashboard.books.create'), 'main_url' => 'dashboard/books/create'],
                            ]
                        ],
                    ]
                ],
                [
                    'level' => 1,
                    'title' => 'الاداره',
                    'childs' => [
                        [
                            'title' => 'الاكواد',
                            'main_url' => 'dashboard/coupone-codes*',
                            'icon' => ' ti-clipboard',
                            'childs' => [
                                ['title' => 'جميع الاكواد', 'url' => route('dashboard.coupone_codes.index'), 'main_url' => 'dashboard/coupone-codes'],
                                ['title' => 'اضافة كود', 'url' => route('dashboard.coupone_codes.create'), 'main_url' => 'dashboard/coupone-codes/create'],
                            ]
                        ],
                        [
                            'title' => 'المحافظات و المناطق',
                            'main_url' => 'dashboard/address*',
                            'icon' => 'ti-map-alt',
                            'childs' => [
                                ['title' => 'المحافظات', 'url' => route('dashboard.governments.index'), 'main_url' => 'dashboard/address/governments'],
                                ['title' => 'المناطق', 'url' => route('dashboard.areas.index'), 'main_url' => 'dashboard/address/areas'],
                            ]
                        ],
                    ]
                ]
                // Add more sidebar items as needed
            ];

            $teacherSidebarItems = [
                [
                    'level' => 2,
                    'childs' => [
                        [
                            'title' => 'الصفحه الرئيسيه',
                            'url' => route('dashboard.teacher.home'), 
                            'icon' => 'ti-home',
                            'main_url' => 'dashboard/teacher/home'
                        ]
                    ]
                ],
                [
                    'level' => 1,
                    'title' => 'المحتوى التعليمي',
                    'childs' => [
                        [
                            'title' => 'الدروس المسجله',
                            'main_url' => 'dashboard/teacher/lessons*',
                            'icon' => 'ti-video-camera',
                            'childs' => [
                                ['title' => 'جميع الفيديوهات', 'url' => route('dashboard.teacher.recorded-lessons.index'), 'main_url' => 'dashboard/teacher/lessons'],
                                ['title' => 'اضافة فيديو', 'url' => route('dashboard.teacher.recorded-lessons.create'), 'main_url' => 'dashboard/teacher/lessons/create'],
                            ]
                        ],
                        [
                            'title' => 'الامتحانات',
                            'main_url' => 'dashboard/teacher/exams*',
                            'icon' => ' ti-clipboard',
                            'childs' => [
                                ['title' => 'جميع الامتحانات', 'url' => route('dashboard.teacher.exams.index'), 'main_url' => 'dashboard/teacher/exams'],
                                ['title' => 'اضافة امتحان', 'url' => route('dashboard.teacher.exams.create'), 'main_url' => 'dashboard/teacher/exams/create'],
                            ]
                        ],
                        [
                            'title' => 'الكتب',
                            'main_url' => 'dashboard/teacher/books*',
                            'icon' => ' ti-book',
                            'childs' => [
                                ['title' => 'جميع الكتب', 'url' => route('dashboard.teacher.books.index'), 'main_url' => 'dashboard/teacher/books'],
                                ['title' => 'اضافة كتاب', 'url' => route('dashboard.teacher.books.create'), 'main_url' => 'dashboard/teacher/books/create'],
                            ]
                        ],
                    ]
                ],
                [
                    'level' => 1,
                    'title' => 'الاداره',
                    'childs' => [
                        [
                            'title' => 'الاكواد',
                            'main_url' => 'dashboard/teacher/coupone-codes*',
                            'icon' => ' ti-clipboard',
                            'childs' => [
                                ['title' => 'جميع الاكواد', 'url' => route('dashboard.teacher.coupone_codes.index'), 'main_url' => 'dashboard/teacher/coupone-codes'],
                                ['title' => 'اضافة كود', 'url' => route('dashboard.teacher.coupone_codes.create'), 'main_url' => 'dashboard/teacher/coupone-codes/create'],
                            ]
                        ],
                    ]
                ]
            ];

            // Use a view composer to bind the sidebar items to all views
            View::composer('*', function ($view) use ($sidebarItems, $teacherSidebarItems) {
                $view->with('sidebarItems', Auth::user() != null ? (Auth::user()->hasRole('admin') ? $sidebarItems : $teacherSidebarItems) : []);
            });
        });
    }
}
