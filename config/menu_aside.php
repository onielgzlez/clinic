<?php
// Aside menu
/*return [

    'items' => [
        // Dashboard
        [
            'title' => 'INI',
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
            'title' => 'INICIO',
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
            'role' => ['Administrador', 'Administrador clínica', 'Secretaria'],
        ],
        [
            'title' => 'Pacientes',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Consultar Pacientes',
                    'bullet' => 'dot',
                    'page' => 'patients',                    
                ],
                [
                    'title' => 'Crear Paciente',
                    'bullet' => 'dot',
                    'page' => 'patients/create',                    
                ],                                    
            ],
            'role' => ['Administrador', 'Administrador clínica', 'Secretaria','Especialista'],
        ],
        [
            'title' => 'Historias Clinicas',
            'icon' => 'flaticon-clipboard',
            'page' => 'histories',
            'root' => true,
            'role' => ['Administrador', 'Administrador clínica', 'Secretaria','Especialista'],
        ],
        [
            'title' => 'Citas',
            'icon' => 'flaticon-interface-5',
            'page' => 'appointments',
            'root' => true,
            'role' => ['Administrador', 'Administrador clínica', 'Secretaria','Especialista'],
        ],
        [
            'title' => 'Finanzas',
            'icon' => 'flaticon-coins',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Consultar Finanzas',
                    'bullet' => 'dot',
                    'page' => 'finances',                    
                ],
                [
                    'title' => 'Crear Cobro',
                    'bullet' => 'dot',
                    'page' => 'finances/create',                    
                ], 
            ],             
            'role' => ['Administrador', 'Administrador clínica', 'Secretaria','Contadora'],
        ],
        // Config
        [
            'section' => 'Configuración',
            'role' => ['Administrador', 'Administrador clínica', 'Secretaria'],
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
            ],
            'role' => ['Administrador', 'Administrador clínica', 'Secretaria'],
        ],
        [
            'title' => 'Usuarios',
            'icon' => 'flaticon2-user-1',            
            'role' => 'Administrador',
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
            'role' => ['Administrador', 'Administrador clínica'],
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

];
