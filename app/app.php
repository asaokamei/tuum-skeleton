<?php

use Slim\App;
use Tuum\Builder\AppBuilder;


/**
 * @param AppBuilder $builder
 * @return App
 */
    function build_demo_application(AppBuilder $builder) {

        // Instantiate the app
        $settings     = $builder->configure('Demo/settings');
        $builder->app = new App($settings);

        // Set up dependencies
        $builder->configure('dependencies');

        // Register middleware
        $builder->configure('middleware');

        // Register routes
        $builder->configure('Demo/routes');

        return $builder->app;

    }
