<?php

return [
    'title' => [
        'index' => 'Listado de usuarios',
        'trash' => 'Papelera de usuarios',
    ],

    'roles' => ['admin' => 'Admin', 'user' => 'Usuario'],
    'states' => ['active' => 'Activo', 'inactive' => 'Inactivo'],

    'filters' => [
        'roles' => ['' => 'Rol', 'admin' => 'Administradores', 'user' => 'Usuarios'],
        'states' => ['' => 'Todos', 'active' => 'Solo activos', 'inactive' => 'Solo inactivos'],
    ]
];
