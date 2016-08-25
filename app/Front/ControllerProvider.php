<?php
namespace App\Front;

use App\Config\Utils\AbstractServiceProvider;
use App\Front\Controller\SampleController;
use App\Front\Presenter\SamplePresenter;
use Interop\Container\ContainerInterface;
use Tuum\Respond\Responder;

class ControllerProvider extends AbstractServiceProvider
{
    /**
     * @return array
     */
    public function getServices()
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
    public function getSampleController(ContainerInterface $c)
    {
        return new SampleController($c->get(Responder::class));
    }

    /**
     * @param ContainerInterface $c
     * @return SamplePresenter
     */
    public function getSamplePresenter(ContainerInterface $c)
    {
        return new SamplePresenter($c->get(Responder::class));
    }
}