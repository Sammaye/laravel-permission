<?php
return [
    'permissions' => [
        'root',
        'admin' => [
            'admin-user',
            'admin-request',
        ],
    ],

    'user' => \App\User::class,
    'permission' => \sammaye\Permission\Permission::class,
    'role' => \sammaye\Permission\Role::class,
];
