<?php
/** @var \Tuum\Builder\AppBuilder $builder */
use Tuum\Respond\Helper\ServiceOptions;
use Tuum\Builder\AppBuilder;

return [
    'settings' => [
        // set to false in production
        'displayErrorDetails' => $builder->debug,

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
    
    /**
     * set builder itself in container.  
     */
    AppBuilder::class => $builder,

    /**
     * options for Tuum/Responder.
     * use ServiceOption object to help set options.
     */
    ServiceOptions::class => ServiceOptions::forge($builder->app_dir . '/Demo/templates/')
        ->setRenderer(ServiceOptions::RENDERER_PLATES)
        ->setErrorFiles('errors/forbidden', 403)
        ->setErrorFiles('errors/notFound', 404)
    ,
];
