<?php

return [

    'tables' => [

        'users' => [
            'table_name' => 'users',
            'foreign_key' => 'id',
            'key_type' => 'unsignedBigInteger'
        ],

        'currencies' => [
            'table_name' => 'currencies',
            'foreign_key' => 'id',
            'key_type' => 'unsignedSmallInteger'
        ]

    ]
];
