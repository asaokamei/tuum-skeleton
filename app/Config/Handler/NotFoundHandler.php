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
     * @param AppBuilder $builder
     * @return NotFoundHandler
     */
    public static function forge(AppBuilder $builder)
    {
        $self = new self();
        $self->isProduction = $builder->isProduction();
        
        return $self;
    }

    /**
     * @param ContainerInterface $c
     * @return callable
     */
    public function __invoke(ContainerInterface $c)
    {
        $this->responder = $c->get(Responder::class);
        return [$this, 'notFound'];
    }

    /**
     * @param ServerRequestInterface $req
     * @param ResponseInterface      $res
     * @return ResponseInterface
     */
    public function notFound(ServerRequestInterface $req, ResponseInterface $res)
    {
        return $this->responder->error($req, $res)->notFound();
    }
}