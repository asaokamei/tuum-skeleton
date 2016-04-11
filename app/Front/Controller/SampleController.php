<?php
namespace App\Front\Controller;

use App\Front\Presenter\SamplePresenter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tuum\Respond\Controller\DispatchByMethodTrait;
use Tuum\Respond\Responder;
use Tuum\Respond\Responder\Redirect;
use Tuum\Respond\Responder\View;

class SampleController
{
    use DispatchByMethodTrait;

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
     * @return View
     */
    protected function view()
    {
        return $this->responder->view($this->request, $this->response);
    }

    /**
     * @return Redirect
     */
    protected function redirect()
    {
        return $this->responder->redirect($this->request, $this->response);
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
     * @return ResponseInterface
     */
    public function onGet()
    {
        $viewData = $this->responder->getViewData();
        return $this->view()->call(SamplePresenter::class, $viewData);
    }

    /**
     * @param string $name
     * @return ResponseInterface
     */
    public function onPost($name = '')
    {
        $viewData = $this->responder->getViewData();
        $viewData->setInputData([
                                    'name' => $name,
                                ])
            ->setSuccess('Hello, Redirected Back!');
        return $this->redirect()->toReferrer($viewData);
    }
}