<?php
namespace App\Config\Utils;

use ArrayAccess;
use Interop\Container\ContainerInterface;

abstract class AbstractServiceProvider
{
    /**
     * overwrite this method.
     * since static method cannot be abstract method.
     *
     * @return array
     */
    abstract public function getServices();

    /**
     * @param ArrayAccess|ContainerInterface $container
     */
    public static function setUp($container)
    {
        $self = new static();
        $self->load($container);
    }

    /**
     * @param ArrayAccess|ContainerInterface $container
     */
    public function load($container)
    {
        foreach ($this->getServices() as $key => $method) {
            $container[$key] = function ($c) use($method) {
                return $this->$method($c);
            };
        }

    }
}