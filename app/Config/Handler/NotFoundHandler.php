<?php
namespace App\Config\Handler;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tuum\Builder\AppBuilder;
use Tuum\Respond\Responder;

class NotFoundHandler
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var bool
     */
    private $isProduction;

    /**
     * @param AppBuilder         $builder
     * @param ContainerInterface $c
     * @return NotFoundHandler
     */
    public static function forge(AppBuilder $builder, ContainerInterface $c)
    {
        $self = new self();
        $self->isProduction = $builder->isProduction();
        $self->responder = $c->get(Responder::class);

        return $self;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->responder->error($request, $response)->notFound();
    }
}