<?php
namespace App\Config;

use App\Config\Service\LoggerFactory;
use App\Config\Service\ResponderFactory;
use App\Config\Handler\NotFoundHandler;
use App\Config\Utils\AbstractServiceProvider;
use Interop\Container\ContainerInterface;
use Monolog\Logger;
use Tuum\Builder\AppBuilder;
use Tuum\Respond\Responder;

class ServiceProvider
{
    /**
     * ServiceProvider constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return ServiceProvider
     */
    public static function forge()
    {
        return new self();
    }

    /**
     * overwrite this method.
     * since static method cannot be method.
     *
     * @return array
     */
    public function getServices()
    {
        return [
            'logger'          => [$this, 'getLogger'],
            'notFoundHandler' => [$this, 'getNotFound'],
        ];
    }

    /**
     * @param ContainerInterface $c
     * @return Logger
     */
    public function getLogger(ContainerInterface $c)
    {
        return LoggerFactory::forge($c->get(AppBuilder::class))->__invoke($c);
    }

    /**
     * @param ContainerInterface $c
     * @return callable|NotFoundHandler
     */
    public function getNotFound(ContainerInterface $c)
    {
        return NotFoundHandler::forge($c->get(AppBuilder::class), $c);
    }
}

