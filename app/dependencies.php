<?php
use App\Config\Define\GuardFactory;
use App\Config\Define\LoggerFactory;
use App\Config\Define\ResponderFactory;
use App\Config\Handler\NotFoundHandler;
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
};
