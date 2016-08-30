<?php
namespace App\Config\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tuum\Locator\FileInfo;
use Tuum\Locator\FileMap;
use Tuum\Respond\Responder;

class DocumentMap
{
    /**
     * @var FileMap
     */
    private $mapper;

    /**
     * @var Responder
     */
    private $responder;

    /**
     * @var string
     */
    public $index_file = 'index';

    /**
     * @var ServerRequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(FileMap $mapper, $responder)
    {
        $this->mapper    = $mapper;
        $this->responder = $responder;
    }

    /**
     * factory for this class.
     *
     * @param Responder $responder
     * @param string    $docs_dir
     * @return DocumentMap
     */
    public static function forge($responder, $docs_dir)
    {
        $mapper   = FileMap::forge($docs_dir);
        $self     = new self($mapper, $responder);
        
        $mapper->renderer->addViewExtension('php', [$self, 'render'], 'text_html');
        
        return $self;
    }

    /**
     * @param FileInfo $found
     * @return FileInfo
     */
    public function render($found)
    {
        $path = $found->getPath();
        $res  =  $this->responder->view($this->request, $this->response)->render($path);
        $found->setContents($res->getBody()->getContents());
        return $found;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable               $next
     * @return ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        $this->request = $request;
        $this->response = $response;
        $path = $request->getUri()->getPath();
        $info = $this->mapper->render($path);
        if (!$info->found()) {
            return $next($request, $response);
        }
        if ($fp = $info->getResource()) {
            return $this->responder->view($request, $response)->asFileContents($fp, $info->getMimeType());
        }
        $view = $this->responder->view($request, $response);
        return $view->asContents($info->getContents());
    }
}