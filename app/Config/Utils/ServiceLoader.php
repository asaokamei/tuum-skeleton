<?php
namespace App\Config\Utils;

use ArrayAccess;
use Interop\Container\ContainerInterface;
use Pimple\Tests\Fixtures\PimpleServiceProvider;

/**
 * Class ServiceLoader
 * 
 * to load services to Pimple container using 'service providers', 
 * objects implementing 'getServices' method. 
 *
 * @package App\Config\Utils
 */
class ServiceLoader
{
    /**
     * @var ArrayAccess|ContainerInterface|PimpleServiceProvider
     */
    private $container;

    /**
     * ServiceLoader constructor.
     *
     * @param ArrayAccess|ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param object $provider
     */
    public function load($provider)
    {
        if (!method_exists($provider, 'getServices')) {
            throw new \InvalidArgumentException('service provider must have getServices method');
        }
        $services = $provider->getServices();
        foreach($services as $key => $factory) {
            $this->container[$key] = function($c) use($factory) {
                return $factory($c);
            };
        }
    }
}