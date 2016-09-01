<?php
/** @var \Tuum\Builder\AppBuilder $builder */
return [
    'settings' => [
        // set to false in production
        'displayErrorDetails' => $builder->debug,

        /**
         * view and template settings for Tuum/Respond
         */
        'respond-options'        => [
            'app-name'       => 'tuum-app',
            'template-path' => $builder->app_dir . '/Demo/templates/',
            'content-file'  => 'layouts/contents',
            'renderer'       => 'plates',   // set renderer type: plates, twig, or tuum.
            'plates-options' => [
                'options'  => [],
                'callback' => null,
            ],
            'error-files'   => [
                'default' => 'errors/error',
                'status'  => [
                    '404' => 'errors/notFound',
                    '403' => 'errors/forbidden',
                ],
            ],
        ],

        // Monolog settings
        'logger'              => [
            'name' => 'slim-app',
            'path' => $builder->var_dir . '/logs/app.log',
        ],

        /**
         * set build options used in AppBuilder.
         */
        'build-options' => $builder->getOptions(),
    ],
];
