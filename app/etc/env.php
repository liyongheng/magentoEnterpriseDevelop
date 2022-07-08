<?php
return [
    'backend' => [
        'frontName' => 'admin'
    ],
    'queue' => [
        'consumers_wait_for_messages' => 1
    ],
    'crypt' => [
        'key' => 'cf1f3d5a7180c5a193ccf8bbd0495b25'
    ],
    'db' => [
        'table_prefix' => '',
        'connection' => [
            'default' => [
                'host' => 'lamp-database',
                'dbname' => 'magento',
                'username' => 'root',
                'password' => '123456',
                'model' => 'mysql4',
                'engine' => 'innodb',
                'initStatements' => 'SET NAMES utf8;',
                'active' => '1',
                'driver_options' => [
                    1014 => false
                ]
            ]
        ]
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => 'default',
    'session' => [
        'save' => 'files'
    ],
    // 'cache' => [
    //     'frontend' => [
    //         'default' => [
    //             'id_prefix' => 'f37_'
    //         ],
    //         'page_cache' => [
    //             'id_prefix' => 'f37_'
    //         ]
    //     ]
    // ],
    'cache' => [
        'frontend' => [
            'default' => [
                'backend' => 'Cm_Cache_Backend_Redis',
                'backend_options' => [
                    'server' => '192.168.31.100',
                    'database' => '0',
                    'port' => '6379'
                ]   
            ],  
            'page_cache' => [
                'backend' => 'Cm_Cache_Backend_Redis',
                'backend_options' => [
                    'server' => '192.168.31.100',
                    'port' => '6379',
                    'database' => '0',
                    'compress_data' => '0' 
                ]
            ]
        ]
    ],
    'lock' => [
        'provider' => 'db',
        'config' => [
            'prefix' => null
        ]
    ],
    'cache_types' => [
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'compiled_config' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'full_page' => 1,
        'config_webservice' => 1,
        'translate' => 1,
        'vertex' => 1
    ],
    'downloadable_domains' => [
        '192.168.31.8'
    ],
    'install' => [
        'date' => 'Wed, 29 Jun 2022 14:16:29 +0000'
    ]
];
