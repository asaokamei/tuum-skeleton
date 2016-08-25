<?php
namespace App\Demo\Front\Controller;

use App\Demo\Front\Presenter\SamplePresenter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tuum\Respond\Controller\DispatchByMethodTrait;
use Tuum\Respond\Controller\ResponderHelperTrait;
use Tuum\Respond\Responder;
use Tuum\Respond\Responder\Redirect;
use Tuum\Respond\Responder\View;

class SampleController
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
        return $this->view()->call(SamplePresenter::class);
    }

    /**
     * @param string $name
     * @return ResponseInterface
     */
    public function onPost($name = '')
    {
        $this->getViewData()->setInput([
                                    'name' => $name,
                                ])
            ->setSuccess('Hello, Redirected Back!');
        return $this->redirect()->toReferrer();
    }
}