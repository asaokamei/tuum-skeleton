<?php
namespace App\Front\Presenter;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tuum\Respond\Interfaces\PresenterInterface;
use Tuum\Respond\Interfaces\ViewDataInterface;
use Tuum\Respond\Responder;

class SamplePresenter implements PresenterInterface
{
    /**
     * @var Responder
     */
    private $responder;

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
     * renders $view_file with $data.
     *
     * @param ServerRequestInterface  $request
     * @param ResponseInterface       $response
     * @param mixed|ViewDataInterface $viewData
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $viewData)
    {
        return $this->responder->view($request, $response)->render('sample', $viewData);
    }
}