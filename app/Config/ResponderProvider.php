<?php
namespace App\Config;

use App\Config\Utils\AbstractServiceProvider;
use Interop\Container\ContainerInterface;
use Tuum\Respond\Helper\ProviderTrait;

class ResponderProvider extends AbstractServiceProvider
{
    use ProviderTrait;

    /**
     * ResponderProvider constructor.
     *
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->setOptions($options);
    }

    /**
     * @param ContainerInterface $c
     * @return ResponderProvider
     */
    public static function forge($c)
    {
        $options = $c->get('settings')['respond-options'];
        return new self($options);
    }

    /**
     * overwrite this method.
     * since static method cannot be method.
     *
     * @return array
     */
    public function getServices()
    {
        return $this->getRespondList();
    }
}