<?php

use Slim\App;
use Tuum\Builder\AppBuilder;


/**
 * @param array $config
 * @return App
 */
    function build_demo_application(array $config) {
        $builder = AppBuilder::forge(
            __DIR__,
            dirname(__DIR__) . '/var',
            $config
        );

        // Instantiate the app
        $settings     = $builder->configure('settings');
        $builder->app = new App($settings);

        // Set up dependencies
        $builder->configure('dependencies');

        // Register middleware
        $builder->configure('middleware');

        // Register routes
        $builder->configure('routes');

        return $builder->app;

    }
