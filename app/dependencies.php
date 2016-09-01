<?php
use App\Config\MiddlewareProvider;
use App\Config\ResponderProvider;
use App\Config\ServiceProvider;
use App\Demo\Front\ControllerProvider;
use Interop\Container\ContainerInterface;
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
    /** @var ContainerInterface $container */
    $container = $app->getContainer();

    ServiceProvider::forge($builder)->load($container);
    ResponderProvider::forge($container)->load($container);
    MiddlewareProvider::setUp($container);
    ControllerProvider::setUp($container);
};
