<?php

return [

    'paths' => [
        /*
        |--------------------------------------------------------------------------
        | Modules path
        |--------------------------------------------------------------------------
        */
        'modules' => base_path('modules'),

        /*
        |--------------------------------------------------------------------------
        | Modules assets path
        |--------------------------------------------------------------------------
        */
        'assets' => public_path('modules'),

        /*
        |--------------------------------------------------------------------------
        | Module dirs
        |--------------------------------------------------------------------------
        | 
        */
       
        'dirs' => [
            'data'             => 'Data',
            'command'          => 'Console',
            'migration'        => 'Database/Migrations',
            'seeder'           => 'Database/Seeders',
            'factory'          => 'Database/Factories',
            'model'            => 'Models',
            'controller_front' => 'Http/Controllers',
            'controller_admin' => 'Http/Controllers/Admin',
            'controller_api'   => 'Http/Controllers/Api',
            'middleware'       => 'Http/Middleware',
            'request'          => 'Http/Requests',
            'provider'         => 'Providers',
            'assets'           => 'Resources/assets',
            'lang'             => 'Resources/lang',
            'views'            => 'Resources/views',
            'test'             => 'Tests',
            'repository'       => 'Repositories',
            'event'            => 'Events',
            'hook'             => 'Hook',
            'listener'         => 'Listeners',
            'policies'         => 'Policies',
            'rules'            => 'Rules',
            'jobs'             => 'Jobs',
            'emails'           => 'Emails',
            'notifications'    => 'Notifications',
            'traits'           => 'Traits',
        ],

        /*
        |--------------------------------------------------------------------------
        | Module files
        |--------------------------------------------------------------------------
        | 
        */        
        'files' => [
            'module'         => 'module.json',
            'composer'       => 'composer.json',
            'start'          => 'start.php',
            'config'         => 'config.php',
            'permission'     => 'permission.php',
            'routes_admin'   => 'Routes/admin.php',
            'routes_api'     => 'Routes/api.php',
            'routes_front'   => 'Routes/front.php',
            'routes_console' => 'Routes/console.php',                  
        ]
    ],
    /*
    |--------------------------------------------------------------------------
    | Scan Path
    |--------------------------------------------------------------------------
    |
    | Here you define which folder will be scanned. By default will scan vendor
    | directory. This is useful if you host the package in packagist website.
    |
    */

    'scan' => [
        'enabled' => false,
        'paths'   => [
            base_path('vendor/*/*'),
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Composer 设置
    |--------------------------------------------------------------------------
    */

    'composer' => [
        'vendor' => 'zotop',
        'author' => [
            'name'     => 'ZotopTeam',
            'email'    => 'cms@zotop.com',
            'homepage' => 'http://www.zotop.com',
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | 缓存设置
    |--------------------------------------------------------------------------
    */
    'cache' => [
        'enabled'  => true,
        'key'      => 'zotop-modules',
        'lifetime' => 60,
    ],
    
    /*
    |--------------------------------------------------------------------------
    | 核心模块
    | 系统必须按照的核心模块，禁止禁用、卸载、删除
    | Add by hankx_chen
    |--------------------------------------------------------------------------
    */
    'cores' => [
        'core',
        'site',
    ],    
];
