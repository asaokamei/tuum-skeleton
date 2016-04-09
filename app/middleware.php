<?php
use App\Config\Middleware\AccessLog;
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

    /**
     * C.S.R.F. guardian by Slim.
     *
     * @return Guard
     */
    $app->add($container['csrf']);

    /**
     * set $responder to request (to use Respond proxy).
     */
    $app->add(TuumStack::forge($container));

    /**
     * access log
     */
    $app->add(AccessLog::forge($container));

    return;

};

