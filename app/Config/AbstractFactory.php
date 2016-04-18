<?php
namespace App\Config;

use ArrayAccess;
use Interop\Container\ContainerInterface;

abstract class AbstractFactory
{
    /**
     * overwrite this method.
     * since static method cannot be abstract method.
     *
     * @return array
     */
    public static function getServices()
    {
        return [];
    }

    /**
     * @param ArrayAccess|ContainerInterface $container
     */
    public static function setUp($container)
    {
        foreach (static::getServices() as $key => $method) {
            $container[$key] = function ($c) use($method) {
                return self::$method($c);
            };
        }
    }

}