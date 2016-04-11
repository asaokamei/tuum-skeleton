<?php
namespace App\Front;

use App\Front\Controller\SampleController;
use App\Front\Presenter\SamplePresenter;
use ArrayAccess;
use Interop\Container\ContainerInterface;
use Tuum\Respond\Responder;

class ControllerFactory
{
    /**
     * @param ArrayAccess $container
     */
    public static function setUp($container)
    {
        foreach (self::getServices() as $key => $method) {
            $container[$key] = function ($c) use($method) {
                return self::$method($c);
            };
        }
    }

    /**
     * @return array
     */
    public static function getServices()
    {
        return [
            SampleController::class => 'getSampleController',
            SamplePresenter::class  => 'getSamplePresenter',
        ];
    }

    /**
     * @param ContainerInterface $c
     * @return SampleController
     */
    public static function getSampleController(ContainerInterface $c)
    {
        return new SampleController($c->get(Responder::class));
    }

    /**
     * @param ContainerInterface $c
     * @return SampleController
     */
    public static function getSamplePresenter(ContainerInterface $c)
    {
        return new SamplePresenter($c->get(Responder::class));
    }
}