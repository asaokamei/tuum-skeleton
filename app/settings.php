<?php
/** @var \Tuum\Builder\AppBuilder $builder */
return [
    'settings' => [
        // set to false in production
        'displayErrorDetails' => $builder->debug,

        /**
         * view and template settings for Tuum/Respond
         */
        'tuum-plates'        => [
            'template-path' => $builder->app_dir . '/templates/',
            'plate-setup'   => null,
            'error-files'   => [
                'default' => 'errors/error',
                'status'  => [
                    '404' => 'errors/notFound',
                    '403' => 'errors/forbidden',
                ],
            ],
            'content-file'  => 'layouts/contents',
        ],

        // Monolog settings
        'logger'              => [
            'name' => 'slim-app',
            'path' => $builder->var_dir . '/logs/app.log',
        ],
        'app-dir'             => $builder->app_dir,
        'var-dir'             => $builder->var_dir,
    ],
];
