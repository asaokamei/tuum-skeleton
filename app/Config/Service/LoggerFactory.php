<?php
namespace App\Config\Service;

use Interop\Container\ContainerInterface;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Tuum\Builder\AppBuilder;

class LoggerFactory
{
    /**
     * @var bool
     */
    private $isDebug;

    /**
     * @param AppBuilder $builder
     * @return LoggerFactory
     */
    public static function forge(AppBuilder $builder)
    {
        $self          = new self();
        $self->isDebug = $builder->debug;

        return $self;
    }

    /**
     * @param ContainerInterface $c
     * @return Logger
     */
    public function __invoke(ContainerInterface $c)
    {
        $settings = $c->get('settings')['logger'];
        $logger   = new Logger($settings['name']);
        $logger->pushProcessor(new UidProcessor());
        $logger->pushHandler(new FingersCrossedHandler(
            new StreamHandler($settings['path'], Logger::DEBUG)
        ));
        if ($this->isDebug) {
            $logger->pushHandler(new StreamHandler($settings['path'], Logger::DEBUG));
        }

        return $logger;
    }
}