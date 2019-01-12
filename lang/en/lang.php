<?php return [
    'plugin' => [
        'name' => 'EEZE Auth',
        'description' => 'Easily integrate with EEZE.io for authentication'
    ],
    'permissions' => [
        'manage_plugin' => 'Manage eeze.io settings',
    ],
    'settings' => [
        'label'         => 'EEZE Authentication',
        'description'   => 'Manage the eeze.io authentication configuration',
        'client_id'     => 'Client ID',
        'client_secret' => 'Client Secret',
        'role_id'       => 'Default Role',
        'hide_login'    => 'Hide normal login fields',
    ],
];