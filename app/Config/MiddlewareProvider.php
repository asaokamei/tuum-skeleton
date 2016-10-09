<?php
namespace App\Config;

use App\Config\Middleware\DocumentMap;
use App\Config\Middleware\GuardFactory;
use App\Config\Middleware\AccessLog;
use App\Config\Middleware\paginateInput;
use App\Config\Middleware\TuumStack;
use App\Config\Utils\AbstractServiceProvider;
use Interop\Container\ContainerInterface;
use Slim\Csrf\Guard;
use Tuum\Pagination\Pager;
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
        $setting   = $c->get('settings')['respond-options'];
        return DocumentMap::forge($c->get(Responder::class), $setting['template-path']);
    }

    /**
     * @param ContainerInterface $c
     * @return PaginateInput
     */
    public function getPaginateInput(ContainerInterface $c)
    {
        return new PaginateInput(new Pager());
    }
}