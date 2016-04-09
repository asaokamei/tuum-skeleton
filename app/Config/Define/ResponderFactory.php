<?php
namespace App\Config\Define;

use Interop\Container\ContainerInterface;
use Tuum\Builder\AppBuilder;
use Tuum\Respond\Helper\ResponderBuilder;
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
     * @return \Tuum\Respond\Responder
     */
    public function __invoke(ContainerInterface $c)
    {
        $setting   = $c->get('settings');
        $stream    = PlatesViewer::forge($setting['template-path']);
        $errors    = ErrorView::forge($stream, [
            'default' => 'errors/error',
            'status'  => [
                '404' => 'errors/notFound',
                '403' => 'errors/forbidden',
            ],
        ]);

        return ResponderBuilder::withServices($stream, $errors, 'layouts/contents')
            ->withSession(SessionStorage::forge('slim-tuum'));
    }
}