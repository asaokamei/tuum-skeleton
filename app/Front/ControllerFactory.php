<?php
namespace App\Front;

use App\Config\AbstractFactory;
use App\Front\Controller\SampleController;
use App\Front\Presenter\SamplePresenter;
use ArrayAccess;
use Interop\Container\ContainerInterface;
use Tuum\Respond\Responder;

class ControllerFactory extends AbstractFactory
{
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