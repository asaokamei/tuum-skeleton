<?php
use App\Config\MiddlewareProvider;
use App\Config\ServiceProvider;
use App\Config\Utils\ServiceLoader;
use App\Demo\Front\ControllerProvider;
use Interop\Container\ContainerInterface;
use Slim\App;
use Tuum\Builder\AppBuilder;
use Tuum\Respond\Helper\ServiceProvider as ResponderProvider;

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

    $loader = new ServiceLoader($container);
    $loader->load(ServiceProvider::forge());
    $loader->load(new ResponderProvider());
    $loader->load(new MiddlewareProvider());
    $loader->load(new ControllerProvider());
};
