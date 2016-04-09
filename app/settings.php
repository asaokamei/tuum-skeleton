<?php
/** @var \Tuum\Builder\AppBuilder $builder */
return [
    'settings' => [
        // set to false in production
        'displayErrorDetails' => $builder->debug, 

        // template settings
        'template-path'       => $builder->app_dir . '/templates/',

        // Monolog settings
        'logger'              => [
            'name' => 'slim-app',
            'path' => $builder->var_dir . '/logs/app.log',
        ],
        'app-dir'             => $builder->app_dir,
        'var-dir'             => $builder->var_dir,
    ],
];
