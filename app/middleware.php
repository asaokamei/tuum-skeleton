<?php
use Slim\App;
use Slim\Csrf\Guard;
use Tuum\Builder\AppBuilder;

/**
 * set up application middleware
 * e.g: $app->add(new \Slim\Csrf\Guard);
 * 
 * @param AppBuilder $builder
 */
return function (AppBuilder $builder) {

    /** @var App $app */
    $app       = $builder->app;

    /**
     * C.S.R.F. guardian by Slim.
     *
     * @return Guard
     */
    $app->add('csrf');

    /**
     * set $responder to request (to use Respond proxy).
     */
    $app->add('tuumStack');

    /**
     * access log
     */
    $app->add('accessLog');

    return;

};

