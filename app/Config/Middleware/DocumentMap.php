<?php
namespace App\Config\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tuum\Locator\FileInfo;
use Tuum\Locator\FileMap;
use Tuum\Respond\Responder;

class DocumentMap
{
    const FOUND_MISC = 'mapped-php';
    
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
     * @param FileInfo $file
     * @return FileInfo
     */
    public function render($file)
    {
        $file->setMisc(self::FOUND_MISC);
        return $file;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable               $next
     * @return ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        $path = $request->getUri()->getPath();
        $file = $this->mapper->render($path);
        if (!$file->found()) {
            return $next($request, $response);
        }
        if ($file->getMisc() === self::FOUND_MISC) {
            return $this->responder->view($request, $response)->render($file->getPath());
        }
        if ($fp = $file->getResource()) {
            return $this->responder->view($request, $response)->asFileContents($fp, $file->getMimeType());
        }
        $view = $this->responder->view($request, $response);
        return $view->asContents($file->getContents());
    }
}