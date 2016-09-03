<?php
namespace App\Demo\Front;

use App\Config\Utils\AbstractServiceProvider;
use App\Demo\Front\Controller\PaginationController;
use App\Demo\Front\Controller\SampleController;
use App\Demo\Front\Presenter\SamplePresenter;
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
            PaginationController::class => 'getPaginationController'
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

    /**
     * @param ContainerInterface $c
     * @return PaginationController
     */
    public function getPaginationController(ContainerInterface $c)
    {
        return new PaginationController($c->get(Responder::class));
    }
}