<?php

return [
    'super_admin_role' => env('RBAC_SUPER_ADMIN_ROLE', 'super-admin'),

    'default_guard' => env('RBAC_DEFAULT_GUARD', 'web'),

    'active_status' => 'active',

    'blocked_statuses' => [
        'inactive',
        'suspended',
    ],
];
