<?php
namespace App\Config;

use App\Config\Factory\GuardFactory;
use App\Config\Middleware\AccessLog;
use App\Config\Middleware\TuumStack;
use Interop\Container\ContainerInterface;
use Slim\Csrf\Guard;

class MiddlewareProvider extends AbstractServiceProvider
{
    /**
     * @return array
     */
    public static function getServices()
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
    public static function getAccessLog(ContainerInterface $c)
    {
        return AccessLog::forge($c);
    }

    /**
     * @param ContainerInterface $c
     * @return TuumStack
     */
    public static function getTuumStack(ContainerInterface $c)
    {
        return TuumStack::forge($c);
    }

    /**
     * @param ContainerInterface $c
     * @return Guard
     */
    public static function getCsRf(ContainerInterface $c)
    {
        return GuardFactory::forge()->__invoke($c);
    }
}