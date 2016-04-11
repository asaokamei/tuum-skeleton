<?php
namespace App\Config\Factory;

use Interop\Container\ContainerInterface;
use Tuum\Builder\AppBuilder;
use Tuum\Respond\Helper\ResponderBuilder;
use Tuum\Respond\Responder;
use Tuum\Respond\Service\ErrorView;
use Tuum\Respond\Service\PlatesViewer;
use Tuum\Respond\Service\SessionStorage;

class ResponderFactory
{
    /**
     * @param AppBuilder $builder
     * @return ResponderFactory
     */
    public static function forge(AppBuilder $builder)
    {
        $self = new self();
        return $self;
    }
    
    /**
     * @param ContainerInterface $c
     * @return Responder
     */
    public function __invoke(ContainerInterface $c)
    {
        $setting   = $c->get('settings')['tuum-plates'];
        return $this->setupPlatesView($setting);
    }

    /**
     * @param array $setting
     * @return Responder
     */
    private function setupPlatesView($setting)
    {
        $viewer = PlatesViewer::forge($setting['template-path'], $setting['plate-setup']);
        $errors = ErrorView::forge($viewer, $setting['error-files']);

        return ResponderBuilder::withServices($viewer, $errors, $setting['content-file'])
                               ->withSession(SessionStorage::forge('slim-tuum'));
    }
}