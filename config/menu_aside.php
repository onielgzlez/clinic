<?php
// Aside menu
/*return [

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
            'title' => 'Personal Medico',
            'icon' => 'flaticon-users',
            'page' => 'especialistas',
            'root' => true,
        ],
        [
            'title' => 'Especialidades',
            'icon' => 'flaticon2-layers',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Consultar Especialidades',
                    'bullet' => 'dot',
                    'page' => 'areas',                    
                ],                                    
            ]
        ],
        [
            'title' => 'Historias Clinicas',
            'icon' => 'flaticon-clipboard',
            'page' => 'areas',
            'root' => true,
        ],
        [
            'title' => 'Citas',
            'icon' => 'flaticon-interface-5',
            'page' => 'citas',
            'root' => true,
        ],
        // Config
        [
            'section' => 'Administracion',
        ],
        [
            'title' => 'Usuarios',
            'icon' => 'flaticon2-user-1',
            'bullet' => 'line',
            'root' => true,  
            'submenu' => [
                [
                    'title' => 'Listar Usuarios',
                    'bullet' => 'dot',
                    'page' => 'users',                    
                ],
                [
                    'title' => 'Crear Usuario',
                    'bullet' => 'dot',
                    'page' => 'users/create',                    
                ],                       
            ]
       
        ],
        [
            'title' => 'Clinicas',
            'icon' => 'flaticon-plus',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Listar Clinicas',
                    'bullet' => 'dot',
                    'page' => 'organizations',                    
                ],
                [
                    'title' => 'Agregar Clinica',
                    'bullet' => 'dot',
                    'page' => 'organizations/create',                    
                ],                        
            ]
        ],
    ]
];*/
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
            'title' => 'Pacientes',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page' => 'patients',
            'root' => true,
            'role' => ['Administrador', 'Administrador clínica', 'Secretaria','Especialista'],
        ],
        // Config
        [
            'section' => 'Configuración',
            'role' => ['Administrador', 'Administrador clínica', 'Secretaria'],
        ],
        [
            'title' => 'Especialidades',
            'icon' => 'flaticon2-layers',
            'page' => 'areas',
            'root' => false,
            'role' => ['Administrador', 'Administrador clínica', 'Secretaria'],
        ],
        [
            'title' => 'Usuarios',
            'icon' => 'flaticon2-user-1',
            'page' => 'users',
            'root' => false,
            'role' => 'Administrador',
        ],        
        [
            'title' => 'Clinicas',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page' => 'organizations',
            'root' => true,
            'role' => ['Administrador', 'Administrador clínica'],
        ],
    ]

];
