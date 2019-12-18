<?php

return [
    '__name' => 'api-profile',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/api-profile.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/api-profile' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'lib-app' => NULL
            ],
            [
                'profile' => NULL
            ],
            [
                'api' => NULL
            ],
            [
                'lib-formatter' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'ApiProfile\\Controller' => [
                'type' => 'file',
                'base' => 'modules/api-profile/controller'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'api' => [
            'apiProfileIndex' => [
                'path' => [
                    'value' => '/profile'
                ],
                'method' => 'GET',
                'handler' => 'ApiProfile\\Controller\\Profile::index'
            ],
            'apiProfileSingle' => [
                'path' => [
                    'value' => '/profile/read/(:identity)',
                    'params' => [
                        'identity' => 'any'
                    ]
                ],
                'method' => 'GET',
                'handler' => 'ApiProfile\\Controller\\Profile::single'
            ]
        ]
    ]
];