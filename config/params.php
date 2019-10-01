<?php
return [
    'user_email' => 'polyaev.maks@ya.ru',
    'enterprices_name' => 'Автопредприятия города',
    'pagination' => '3',
    'add_driver_modal_pages' => [
        0 => [
            'controller' => 'department',
            'action' => 'taxi',
        ],
        1 => [
            'controller' => 'department',
            'action' => 'truck',
        ],
        2 => [
            'controller' => 'department',
            'action' => 'bus'
        ]
    ],
];