<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'admins' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'pages' => 'c,r,u,d',
            'faq' => 'c,r,u,d',
            'country' => 'c,r,u,d',
            'personal_info' => 'u',
            'lang_and_translations' => 'u',
            'payments' => "r",
            'governorate' => 'c,r,u,d',
            'orders' => 'r,d'
        ],
        'admin' => [
            'admins' => 'r',
            'users' => 'c,r,u,d',
            'pages' => 'c,r,u,d',
            'faq' => 'c,r,u,d',
            'country' => 'c,r,u,d',
            'personal_info' => 'u',
            'lang_and_translations' => 'u',
            'payments' => "r",
            'governorate' => 'r,u',
            'orders' => 'r'
        ],
        'user' => [
            'personal_info' => 'u'
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
