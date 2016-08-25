<?php
namespace App\Config\Factory;

use Interop\Container\ContainerInterface;
use Tuum\Builder\AppBuilder;
use Tuum\Respond\Helper\ResponderBuilder;
use Tuum\Respond\Responder;
use Tuum\Respond\Service\ErrorView;
use Tuum\Respond\Service\PlatesViewer;
use Tuum\Respond\Service\Renderer\Plates;
use Tuum\Respond\Service\SessionStorage;

class ResponderFactory
{
    /**
     * @var ContainerInterface
     */
    private $container;

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
        $this->container = $c;
        $setting   = $c->get('settings')['tuum-plates'];
        return $this->setupPlatesView($setting);
    }

    /**
     * a resolver to retrieve objects from container-interface.
     *
     * @param string $toResolve
     * @return mixed|null
     */
    public function resolve($toResolve)
    {
        if ($this->container->has($toResolve)) {
            return $this->container->get($toResolve);
        }
        return null;
    }

    /**
     * @return callable
     */
    private function getResolver()
    {
        return [$this, 'resolve'];
    }

    /**
     * @param array $setting
     * @return Responder
     */
    private function setupPlatesView($setting)
    {
        $viewer = Plates::forge($setting['template-path'], $setting['plate-setup']);
        $errors = ErrorView::forge($viewer, $setting['error-files']);

        return ResponderBuilder::withServices($viewer, $errors, $setting['content-file'], $this->getResolver())
                               ->withSession(SessionStorage::forge('slim-tuum'));
    }
}