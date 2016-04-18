<?php
namespace App\Config\Middleware;

use App\Config\AbstractFactory;
use Interop\Container\ContainerInterface;

class MiddlewareFactory extends AbstractFactory
{
    /**
     * @return array
     */
    public static function getServices()
    {
        return [
            'tuumStack' => 'getTuumStack',
            'accessLog' => 'getAccessLog',
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

}