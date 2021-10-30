<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'flaticon-home', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/dashboard',
            'new-tab' => false,
        ],

        // Custom
        [
            'section' => 'Modulos',
        ],
        [
            'title' => 'Clinicas',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page' => 'organizations',
            'root' => true,
        ],
        // Config
        [
            'section' => 'Configuración',
            'role' => 'Administrador',
        ],
        [
            'title' => 'Usuarios',
            'icon' => 'flaticon-users-1',
            'page' => 'users',
            'root' => false,
            'role' => 'Administrador',
        ]
    ]

];
