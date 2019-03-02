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
];
