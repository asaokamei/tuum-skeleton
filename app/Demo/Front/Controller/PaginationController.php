<?php
namespace App\Demo\Front\Controller;

use App\Demo\Front\Presenter\SamplePresenter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tuum\Pagination\Inputs;
use Tuum\Pagination\Pager;
use Tuum\Pagination\Paginate\PaginateFull;
use Tuum\Pagination\Paginate\PaginateMini;
use Tuum\Pagination\ToHtml\ToBootstrap;
use Tuum\Respond\Controller\DispatchByMethodTrait;
use Tuum\Respond\Controller\ResponderHelperTrait;
use Tuum\Respond\Interfaces\ViewDataInterface;
use Tuum\Respond\Responder;
use Tuum\Respond\Responder\Redirect;
use Tuum\Respond\Responder\View;

class PaginationController
{
    use DispatchByMethodTrait;

    use ResponderHelperTrait;

    /**
     * SampleController constructor.
     *
     * @param Responder $responder
     */
    public function __construct($responder)
    {
        $this->responder = $responder;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param array                  $args
     * @return null|ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        if (is_array($args) && !empty($args)) {
            $request = $request->withQueryParams(array_merge($request->getQueryParams(), $args));
        }
        return $this->dispatch($request, $response);
    }

    /**
     * @param Inputs $input
     * @return ResponseInterface
     */
    public function onGet($input)
    {
        $list = [];
        for($idx = 0; $idx <= $input->getLimit(); $idx++) {
            $list[] = $input->getOffset() + $idx;
        }
        $total = is_numeric($input->get('total')) ? $input->get('total'): 500;
        $input->setTotal($total);
        $input->setList($list);
        $paginate = new PaginateMini();
        $paginate = $paginate->withInputs($input);
        $pageList = new ToBootstrap();
        $pageList = $pageList->withPaginate($paginate);
        return $this->view()
            ->withView(function(ViewDataInterface $view) use($input, $pageList) {
                return $view
                    ->setData('input', $input)
                    ->setData('pages', $pageList);
            })
            ->render('pages');
    }
}