<?php
use App\Config\Factory\GuardFactory;
use App\Config\Factory\LoggerFactory;
use App\Config\Factory\ResponderFactory;
use App\Config\Handler\NotFoundHandler;
use App\Front\ControllerFactory;
use Slim\App;
use Tuum\Builder\AppBuilder;
use Tuum\Respond\Responder;

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

    $container['logger']          = LoggerFactory::forge($builder);
    $container['notFoundHandler'] = NotFoundHandler::forge($builder);
    $container['csrf']            = GuardFactory::forge($builder);
    $container[Responder::class]  = ResponderFactory::forge($builder);
    ControllerFactory::setUp($container);
};
