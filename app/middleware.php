<?php
use App\Config\Middleware\AccessLog;
use App\Config\Middleware\MiddlewareFactory;
use App\Config\Middleware\TuumStack;
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
    $container = $app->getContainer();
    MiddlewareFactory::setUp($container);

    /**
     * C.S.R.F. guardian by Slim.
     *
     * @return Guard
     */
    $app->add($container['csrf']);

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

