<?php
use App\Config\MiddlewareProvider;
use App\Config\ServiceProvider;
use App\Front\ControllerProvider;
use Slim\App;
use Tuum\Builder\AppBuilder;

/**
 * setup container
 *
 * @param AppBuilder $builder
 */
return function (AppBuilder $builder) {

    /**
     * @var App
     */
    $app       = $builder->app;
    $container = $app->getContainer();

    ServiceProvider::forge($builder)->load($container);
    MiddlewareProvider::setUp($container);
    ControllerProvider::setUp($container);
};
