<?php
namespace App\Config;

use App\Config\Middleware\DocumentMap;
use App\Config\Middleware\GuardFactory;
use App\Config\Middleware\AccessLog;
use App\Config\Middleware\TuumStack;
use Interop\Container\ContainerInterface;
use Slim\Csrf\Guard;
use Tuum\Pagination\Pager;
use Tuum\Respond\Helper\ServiceOptions;
use Tuum\Respond\Responder;

class MiddlewareProvider
{
    /**
     * @return array
     */
    public function getServices()
    {
        return [
            'tuumStack' => [$this, 'getTuumStack'],
            'accessLog' => [$this, 'getAccessLog'],
            'csrf'      => [$this, 'getCsRf'],
            'fileMap'   => [$this, 'getDocumentMap'],
            'paginate'  => [$this, 'getPaginateInput'],
        ];
    }

    /**
     * @param ContainerInterface $c
     * @return AccessLog
     */
    public function getAccessLog(ContainerInterface $c)
    {
        return AccessLog::forge($c);
    }

    /**
     * @param ContainerInterface $c
     * @return TuumStack
     */
    public function getTuumStack(ContainerInterface $c)
    {
        return TuumStack::forge($c);
    }

    /**
     * @param ContainerInterface $c
     * @return Guard
     */
    public function getCsRf(ContainerInterface $c)
    {
        return GuardFactory::forge()->__invoke($c);
    }

    /**
     * @param ContainerInterface $c
     * @return DocumentMap
     */
    public function getDocumentMap(ContainerInterface $c)
    {
        /** @var ServiceOptions $options */
        $options   = $c->get(ServiceOptions::class);
        $template  = $options->toArray()['template-path'];
        return DocumentMap::forge($c->get(Responder::class), $template);
    }

    /**
     * @return PaginateInput
     */
    public function getPaginateInput()
    {
        return new PaginateInput(new Pager());
    }
}