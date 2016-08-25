<?php
namespace App\Config;

use App\Config\Middleware\GuardFactory;
use App\Config\Middleware\AccessLog;
use App\Config\Middleware\TuumStack;
use App\Config\Utils\AbstractServiceProvider;
use Interop\Container\ContainerInterface;
use Slim\Csrf\Guard;

class MiddlewareProvider extends AbstractServiceProvider
{
    /**
     * @return array
     */
    public function getServices()
    {
        return [
            'tuumStack' => 'getTuumStack',
            'accessLog' => 'getAccessLog',
            'csrf'      => 'getCsRf',
        ];
    }

    /**
     * @param ContainerInterface $c
     * @return AccessLog
     */
    public function getAccessLog(ContainerInterface $c)
    {
        return AccessLog::forge($c);
    }

    /**
     * @param ContainerInterface $c
     * @return TuumStack
     */
    public function getTuumStack(ContainerInterface $c)
    {
        return TuumStack::forge($c);
    }

    /**
     * @param ContainerInterface $c
     * @return Guard
     */
    public function getCsRf(ContainerInterface $c)
    {
        return GuardFactory::forge()->__invoke($c);
    }
}