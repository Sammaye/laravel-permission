<?php

use App\User;
use sammaye\Permission\Permission;
use sammaye\Permission\Role;

return [
    'permissions' => [
        'root',
        'admin' => [
            'admin-user',
            'admin-request',
        ],
    ],

    'user' => User::class,
    'permission' => Permission::class,
    'role' => Role::class,
];
