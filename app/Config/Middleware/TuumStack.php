<?php
namespace App\Config\Middleware;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tuum\Respond\Respond;
use Tuum\Respond\Responder;

class TuumStack
{
    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Set the LoggerInterface instance.
     *
     * @param ContainerInterface $c
     * @return AccessLog
     */
    public static function forge(ContainerInterface $c)
    {
        $self            = new self();
        $self->container = $c;

        return $self;
    }

    /**
     * save session and responder as $request's attribute.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable               $next
     * @return mixed
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ) {
        $this->responder = $this->container->get(Responder::class);
        $request         = Respond::withResponder($request, $this->responder);

        return $next($request, $response);
    }
}