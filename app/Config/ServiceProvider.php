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

class ServiceProvider extends AbstractServiceProvider
{
    /**
     * @var AppBuilder
     */
    private $builder;

    /**
     * ServiceProvider constructor.
     *
     * @param AppBuilder $builder
     */
    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param AppBuilder $builder
     * @return ServiceProvider
     */
    public static function forge($builder)
    {
        return new self($builder);
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
            'logger'          => 'getLogger',
            'notFoundHandler' => 'getNotFound',
        ];
    }

    /**
     * @param ContainerInterface $c
     * @return Logger
     */
    public function getLogger(ContainerInterface $c)
    {
        return LoggerFactory::forge($this->builder)->__invoke($c);
    }

    /**
     * @param ContainerInterface $c
     * @return callable|NotFoundHandler
     */
    public function getNotFound(ContainerInterface $c)
    {
        return NotFoundHandler::forge($this->builder, $c);
    }

    /**
     * @param ContainerInterface $c
     * @return Responder
     */
    public function getResponder(ContainerInterface $c)
    {
        return ResponderFactory::forge()->__invoke($c);
    }
}

