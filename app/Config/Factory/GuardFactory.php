<?php
namespace App\Config\Factory;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\App;
use Slim\Csrf\Guard;
use Slim\Http\Request;
use Slim\Http\Response;
use Tuum\Builder\AppBuilder;
use Tuum\Respond\Responder;

class GuardFactory
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var AppBuilder
     */
    private $builder;

    /**
     * builds self.
     *
     * @param AppBuilder $builder
     * @return GuardFactory
     */
    public static function forge(AppBuilder $builder)
    {
        $self          = new self;
        $self->builder = $builder;

        return $self;
    }

    /**
     * @param ContainerInterface $c
     * @return Guard
     */
    public function __invoke(ContainerInterface $c)
    {
        $this->responder = $c->get(Responder::class);
        $guard           = new Guard();
        $guard->setFailureCallable([$this, 'forbidden']);

        return $guard;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @return ResponseInterface
     */
    public function forbidden(Request $request, Response $response)
    {
        return $this->responder->error($request, $response)->forbidden();
    }
}