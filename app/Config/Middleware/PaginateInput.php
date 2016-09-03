<?php
namespace App\Config\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tuum\Pagination\Pager;

class PaginateInput
{
    /**
     * @var Pager
     */
    private $pager;

    /**
     * paginateInput constructor.
     *
     * @param Pager $pager
     */
    public function __construct($pager)
    {
        $this->pager = $pager;
    }

    /**
     * Execute the middleware.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable               $next
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $pager = $this->pager->withRequest($request);
        $input = $pager->call(function ($input) {
            return $input;
        });
        $query = $request->getQueryParams();
        $query['input'] = $input;
        $request = $request->withQueryParams($query);
        return $next($request, $response);
    }
}