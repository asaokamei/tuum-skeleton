<?php
namespace App\Config\Middleware;

use Exception;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

/**
 * Class AccessLog
 *
 */
class AccessLog
{
    /**
     * @var LoggerInterface The router container
     */
    private $logger;

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
     * @param ServerRequestInterface $request
     * @return string
     */
    private static function getRemoteIP(ServerRequestInterface $request)
    {
        $server   = $request->getServerParams();
        $remoteIP = isset($server['REMOTE_ADDR']) && filter_var($server['REMOTE_ADDR'], FILTER_VALIDATE_IP)
            ? $server['REMOTE_ADDR']
            : '';

        return $remoteIP;
    }

    /**
     * Execute the middleware.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable               $next
     * @return ResponseInterface
     * @throws Exception
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $time1        = microtime(true);
        $this->logger = $this->container->get('logger');
        /** @var ResponseInterface $response */
        try {

            $response = $next($request, $response);

        } catch (Exception $e) {
            $message = $this->format($request, $response, $time1);
            $this->logger->critical($message, ['exception' => $e, 'trace' => $e->getTrace()]);
            throw $e;
        }
        $message = $this->format($request, $response, $time1);
        if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 600) {
            $this->logger->error($message);
        } else {
            $this->logger->info($message);
        }

        return $response;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param float                  $time1
     * @return string
     */
    private function format($request, $response, $time1)
    {
        $formats   = [];
        $formats[] = $request->getMethod();
        $formats[] = '"' . $request->getUri()->getPath() . '"';
        $formats[] = $response->getReasonPhrase() . '(' . $response->getStatusCode() . ')';
        $formats[] = $this->getRemoteIP($request);
        $formats[] = sprintf('%0.2f kbyte', $response->getBody()->getSize() / 1024);
        $formats[] = sprintf('%0.2f msec', (microtime(true) - $time1) * 1000);

        return implode(', ', $formats);
    }
}