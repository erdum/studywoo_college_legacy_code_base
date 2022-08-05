<?php


class Sidebar
{

    public static function get()
    {
        // in_array()
        return self::$sidebar;
    }

}

//     static $sidebar = [
//         // [
//         //     'navigation' => "Dashboard",
//         //     'children' => [
//         //         [
//         //             'name' => "Dashboard",
//         //             'icon' => "share-2",
//         //             'route' => 'dashboard',
//         //             'param' => null
//         //         ]
//         //     ]
//         // ],

//         [

//             'navigation' => "Basic",
//             "permission" => "Basic Setup",
//             'children' => [
//                 [
//                     'name' => "Basic Setups",
//                     'icon' => "share-2",
//                     'children' => [
//                         [
//                             'name' => "State",
//                             'icon' => "share-2",
//                             'route' => 'state.list',
//                             'param' => null
//                         ],

//                         [
//                             'name' => "City",
//                             'icon' => "share-2",
//                             'route' => 'city.list',
//                             'param' => null
//                         ],

//                         [
//                             'name' => "Course",
//                             'icon' => "share-2",
//                             'route' => 'course.list',
//                             'param' => null
//                         ],
//                         [
//                             'name' => "Entrance Exam",
//                             'icon' => "share-2",
//                             'route' => 'entranceExam.list',
//                             'param' => null
//                         ],
//                         [
//                             'name' => "Affiliated",
//                             'icon' => "share-2",
//                             'route' => 'affiliated.list',
//                             'param' => null
//                         ],
//                         [
//                             'name' => "Stream",
//                             'icon' => "share-2",
//                             'route' => 'stream.list',
//                             'param' => null
//                         ],
//                         [
//                             'name' => "Program Types",
//                             'icon' => "share-2",
//                             'route' => 'program.list',
//                             'param' => null
//                         ],
//                         [
//                             'name' => "College Type",
//                             'icon' => "share-2",
//                             'route' => 'collegeType.list',
//                             'param' => null
//                         ],
//                         [
//                             'name' => "Course Type",
//                             'icon' => "share-2",
//                             'route' => 'courseType.list',
//                             'param' => null
//                         ],



//                     ]
//                 ]

//             ]
//         ],

//         [

//             'navigation' => "College / University",

//             'children' => [
//                 [
//                     'name' => "College / University",
//                     'icon' => "share-2",
//                     'children' => [
//                         [
//                             'name' => " College List",
//                             'icon' => "share-2",
//                             'route' => 'college.list',
//                             'param' => null
//                         ],
//                         [
//                             'name' => "Add College",
//                             "permission" => "Add College",
//                             'icon' => "share-2",
//                             'route' => 'college.getAddEditForm',
//                             'param' => null
//                         ],


//                     ]
//                 ]
//             ]
//         ],
//         [
//             'navigation' => "System",
//             "permission" => "Site Config",
//             // 'children' => [
//             //     [
//             //         'name' => "System Config",
//             //         'icon' => "share-2",
//             //         'route' => 'system-config.getSiteConfig',
//             //         'param' => null
//             //     ],

//                 // [
//                 //     'name' => "SEO",
//                 //     'icon' => "share-2",
//                 //     'route' => 'seo.getAddSeoPage',
//                 //     'param' => null
//                 // ],


//                 [
//                     'name' => "Customer Applications",
//                     'icon' => "share-2",
//                     'route' => 'college.applications',
//                     'param' => null
//                 ],


//             ]
//         ],
//         // [
//         //     'permission'=>'Manage User',
//         //     'navigation' => "User",
//         //     "permission" => "Manage User",
//         //     'children' => [
//         //         [
//         //             'name' => "User Management",
//         //             'icon' => "share-2",
//         //             'children' => [
//         //                 [
//         //                     'name' => "User",
//         //                     'icon' => "share-2",
//         //                     'route' => 'user.list',
//         //                     'param' => null
//         //                 ]


//         //             ]
//         //         ]
//         //     ]
//         // ],
//         // [
//         //     'navigation' => "2 level",
//         //     'children' => [
//         //         [
//         //             'name' => "Level 1",
//         //             'icon' => "share-2",
//         //             'children' => [
//         //                 [
//         //                     'name' => "Level 2",
//         //                     'icon' => "share-2",
//         //                     'route' => "#",
//         //                     'param' => null
//         //                 ],
//         //                 [
//         //                     'name' => "Level 2 B",
//         //                     'icon' => "share-2",
//         //                     'route' => null,
//         //                     'param' => null
//         //                 ]
//         //             ]
//         //         ]
//         //     ]
//         // ]
//     ];
// }
